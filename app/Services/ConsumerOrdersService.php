<?php

namespace App\Services;

use App\ConsumerOrder;

class ConsumerOrdersService
{
    /**
     * Take a collection of consumer orders and group them by date and order:
     * [MMYYYY][OrderId][ConsumerOrder]
     *
     * @param ConsumerOrder[]|\Illuminate\Database\Eloquent\Collection $consumer_orders
     *
     * @return array
     */
    public function groupConsumerOrdersByDateAndOrder($consumer_orders)
    {
        $data = [];
        $current_month = null;
        $current_order = null;
        foreach ($consumer_orders as $consumer_order) {
            if ($consumer_order->month != $current_month) {
                $current_month = $consumer_order->month->format('mY');
                $data[$current_month] = [];
                $data[$current_month][$consumer_order->order_id] = [$consumer_order];
            } else if ($current_order != $consumer_order->order_id) {
                $current_order = $consumer_order->order_id;
            } else {
                $data[$current_month][$current_order][] = $consumer_order;
            }
        }

        return $data;
    }
}
