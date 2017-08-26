<?php

namespace App\Services;

use App\Box;
use App\ConsumerOrdersProduct;
use App\Order;
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
            ->where('consumer_orders.order_id', $order->id);

        if ($from_stock) {
            $query->where('from_stock', true)
                ->whereNotNull('consumer_orders.consumer_id');
        }

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
     * @param bool  $include_incomplete
     *
     * @return int
     */
    public function getBoxes(Order $order, $include_incomplete = false)
    {
        $boxes = collect([]);
        $groupedByBoxType = $order->products->groupBy(function ($item) {
            return $item->product->category->box_type->id;
        });

        foreach ($groupedByBoxType as $boxTypeGroup) {
            $box_type = $boxTypeGroup->first()->product->getBoxType();
            $box = new Box($box_type);

            foreach ($boxTypeGroup as $product) {
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

        return $boxes->filter(function ($item) use ($include_incomplete) {
            return $include_incomplete || $item->isFull();
        });
    }
}
