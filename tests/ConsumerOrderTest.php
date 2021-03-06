<?php

class ConsumerOrderTest extends TestCase
{
    /**
     * Test the consumers' orders relationship with the consumer.
     *
     * @return void
     */
    public function test_consumer_relationship()
    {
        $consumer_order = App\ConsumerOrder::findOrFail(1);
        $this->assertInstanceOf(App\Consumer::class, $consumer_order->consumer);
        $this->assertEquals($consumer_order->consumer->id, 1);

        $consumer_order = App\ConsumerOrder::findOrFail(2);
        $this->assertInstanceOf(App\Consumer::class, $consumer_order->consumer);
        $this->assertEquals($consumer_order->consumer->id, 2);
    }

    /**
     * Test the consumers' orders relationship with the products.
     *
     * @return void
     */
    public function test_products_relationship()
    {
        $consumer_order = App\ConsumerOrder::findOrFail(1);
        $this->assertContainsOnlyInstancesOf(App\Product::class, $consumer_order->products);
        $this->assertCount(4, $consumer_order->products);

        $consumer_order = App\ConsumerOrder::findOrFail(2);
        $this->assertContainsOnlyInstancesOf(App\Product::class, $consumer_order->products);
        $this->assertCount(2, $consumer_order->products);
    }

    /**
     * Test consumer's order pivot relation with product.
     *
     * @return void
     */
    public function test_pivot_relation_with_products()
    {
        $consumer_order = App\ConsumerOrder::findOrFail(1);

        foreach ($consumer_order->products as $product) {
            $this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\Pivot::class, $product->pivot);

            switch ($product->id) {
                case 7:
                    $this->assertEquals(2, $product->pivot->quantity);
                    break;
                case 8:
                    $this->assertEquals(2, $product->pivot->quantity);
                    break;
                case 16:
                    $this->assertEquals(1, $product->pivot->quantity);
                    break;
                case 20:
                    $this->assertEquals(1, $product->pivot->quantity);
                    break;
                default: break;
            }
        }
    }

    /**
     * Test a consumer order month attribute.
     *
     * @return void
     */
    public function test_month_attribute()
    {
        $consumer_order = App\ConsumerOrder::findOrFail(1);
        $this->assertInstanceOf(\Carbon\Carbon::class, $consumer_order->month);
        $consumer_order->month = '04/2015';
        $this->assertInstanceOf(\Carbon\Carbon::class, $consumer_order->month);
        $this->assertEquals('2015-04', $consumer_order->month->format('Y-m'));
    }
}
