<?php

namespace App\Services;

use App\Box;
use App\BoxType;
use App\ConsumerOrdersProduct;
use App\Order;
use App\Stock;
use App\Product;

class OrdersService
{
    /**
     * Return the total quantity of products for a given order.
     *
     * @param Order $order
     * @param bool  $from_stock
     *
     * @return int
     */
    public function getTotalProductsQuantity(Order $order, $from_stock = false)
    {
        $query = ConsumerOrdersProduct::selectRaw('sum(consumer_orders_products.quantity) as total')
            ->join('consumer_orders', function ($join) {
                $join->on('consumer_orders_products.consumer_order_id', '=', 'consumer_orders.id');
            })
            ->where('consumer_orders.order_id', $order->id)
            ->where('from_stock', $from_stock);

        return $query->first()->total ?? 0;
    }

    /**
     * Return the number of the given product in the given order.
     *
     * @param Order   $order
     * @param Product $product
     *
     * @return int|null
     */
    public function getQuantityByProduct(Order $order, Product $product)
    {
        return $order->products()->where('product_id', $product->id)->first()->sum_quantity;
    }

    /**
     * Return the number of completed boxes for the given order.
     *
     * @param Order $order
     * @param bool  $only_incomplete
     *
     * @return Box[]|\Illuminate\Support\Collection
     */
    public function getBoxes(Order $order, $only_incomplete = false)
    {
        $boxes = collect([]);
        $grouped_by_box_type = $order->products->groupBy(function ($item) {
            return $item->product->category->box_type->id;
        });

        foreach ($grouped_by_box_type as $box_type_group) {
            $box_type = $box_type_group->first()->product->getBoxType();
            $box = new Box($box_type);

            foreach ($box_type_group as $product) {
                $remaining = $product->sum_quantity;
                do {
                    if (($remaining = $box->addProduct($product->product, $remaining)) > 0) {
                        $boxes->push($box);
                        $box = new Box($box_type);
                    }
                } while ($remaining > 0);
            }

            $boxes->push($box);
        }

        return $boxes->filter(function ($box) use ($only_incomplete) {
            return !$only_incomplete || ($only_incomplete && !$box->isFull());
        });
    }

    /**
     * Determine the filler candidates for a given order and a stock.
     *
     * @param Order $order
     * @param Stock $stock
     *
     * @return array
     */
    public function getFillerCandidates($order, $stock)
    {
        $stock = $this->updateStockFromExistingFillers($order, $stock);

        $candidates = collect([]);
        foreach ($this->getBoxes($order, true) as $box) {
            while (!$box->isFull(true)) {
                $candidate = $this->getProductCandidate($box->type, $stock);
                $box->addCandidate($candidate);
            }

            $candidates = $candidates->merge($box->candidates);
        }

        return $candidates;
    }

    /**
     * Get a product candidate from a given type and a stock.
     *
     * @param BoxType $boxType
     * @param Stock   $stock
     *
     * @return Product
     */
    private function getProductCandidate(BoxType $boxType, $stock)
    {
        /** @var StockProduct[] $filteredStock */
        $filteredStock = $stock->products->filter(function ($product) use ($boxType) {
            return $product->getProduct()->getBoxType() == $boxType;
        });

        $candidate = $filteredStock->first();
        foreach ($filteredStock->slice(1) as $product) {
            $candidate_value = $candidate->optimalQuantity - $candidate->temporaryQuantity;
            $product_value = $product->optimalQuantity - $product->temporaryQuantity;
            if ($product_value >= $candidate_value) {
                $candidate = $product;
            }
        }
        $candidate->temporaryQuantity = $candidate->temporaryQuantity + 1;

        return $candidate->getProduct();
    }

    /**
     * @param Order $order
     * @param Stock $stock
     *
     * @return Stock
     */
    private function updateStockFromExistingFillers(Order $order, $stock)
    {
        $filler_order = $order->consumer_orders()->whereNull('consumer_id')->first();
        if ($filler_order) {
            foreach ($filler_order->products as $product) {
                $stockProduct = $stock->getStockProduct($product);
                $stockProduct->temporaryQuantity = $stockProduct->quantity + $product->pivot->quantity;
            }
        }

        return $stock;
    }
}
