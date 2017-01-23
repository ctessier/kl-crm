<?php

class ConsumerOrderProductTest extends TestCase
{
    /**
     * Test consumer's order products relationship with consumer order.
     *
     * @return void
     */
    public function test_consumer_order_relationship()
    {
        $consumer_order_product = App\ConsumerOrdersProduct::where([
            'consumer_order_id' => 1,
            'product_id'        => 7,
        ])->firstOrFail();
        $this->assertInstanceOf(App\ConsumerOrder::class, $consumer_order_product->consumer_order);
        $this->assertEquals(1, $consumer_order_product->consumer_order->id);
    }

    /**
     * Test consumer's order products relationship with product.
     *
     * @return void
     */
    public function test_product_relationship()
    {
        $consumer_order_product = App\ConsumerOrdersProduct::where([
            'consumer_order_id' => 1,
            'product_id'        => 7,
        ])->firstOrFail();
        $this->assertInstanceOf(App\Product::class, $consumer_order_product->product);
        $this->assertEquals(7, $consumer_order_product->product->id);
    }
}
