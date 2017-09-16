<?php

class OrderTest extends TestCase
{
    /**
     * Test order relationship with consumer orders.
     *
     * @return void
     */
    public function test_order_has_consumer_orders()
    {
        $consumer_orders = \App\Order::findOrFail(1)->consumer_orders;
        $this->assertContainsOnlyInstancesOf(\App\ConsumerOrder::class, $consumer_orders);
        $this->assertCount(2, $consumer_orders);

        $consumer_orders = \App\Order::findOrFail(2)->consumer_orders;
        $this->assertCount(0, $consumer_orders);
    }
}
