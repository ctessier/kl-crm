<?php

namespace App\Services;

use App\Box;
use App\BoxType;
use App\ConsumerOrdersProduct;
use App\Order;
use App\Product;
use Illuminate\Support\Collection;

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
     * @param Order                                              $order
     * @param Product[]|\Illuminate\Database\Eloquent\Collection $stock
     *
     * @return array
     */
    public function getFillerCandidates($order, $stock)
    {
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
     * @param BoxType    $box_type
     * @param Collection $stock
     *
     * @return Product
     */
    public function getProductCandidate(BoxType $box_type, $stock)
    {
        $filtered_stock = $stock->filter(function ($product) use ($box_type) {
            return $product->getBoxType() == $box_type;
        });

        $candidate = $filtered_stock->first();
        foreach ($filtered_stock->slice(1) as $product) {
            $candidate_value = $candidate->pivot->optimal_quantity - $candidate->pivot->quantity;
            $product_value = $product->pivot->optimal_quantity - $product->pivot->quantity;
            if ($product_value >= $candidate_value) {
                $candidate = $product;
            }
        }
        $candidate->pivot->quantity++;

        return $candidate;
    }
}
