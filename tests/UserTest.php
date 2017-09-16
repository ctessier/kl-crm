<?php

class UserTest extends TestCase
{
    /**
     * Test user relationship with consumers.
     *
     * @return void
     */
    public function test_user_has_consumers()
    {
        $userConsumers = \App\User::findOrFail(1)->consumers;
        $this->assertContainsOnlyInstancesOf(\App\Consumer::class, $userConsumers);
        $this->assertCount(3, $userConsumers);

        $userConsumers = \App\User::findOrFail(2)->consumers;
        $this->assertContainsOnlyInstancesOf(\App\Consumer::class, $userConsumers);
        $this->assertCount(2, $userConsumers);
    }

    /**
     * Test user relationship with consumer orders.
     *
     * @return void
     */
    public function test_consumer_order_relationship()
    {
        $userConsumerOrders = \App\User::findOrFail(1)->consumer_orders;
        $this->assertContainsOnlyInstancesOf(\App\ConsumerOrder::class, $userConsumerOrders);
        $this->assertCount(2, $userConsumerOrders);

        $userConsumerOrders = \App\User::findOrFail(2)->consumer_orders;
        $this->assertCount(0, $userConsumerOrders);
    }

    /**
     * Test the user's relationship with the products.
     *
     * @return void
     */
    public function test_products_relationship()
    {
        $user = App\User::findOrFail(1);
        $this->assertContainsOnlyInstancesOf(App\Product::class, $user->products);
    }

    /**
     * Test user pivot relation with products.
     *
     * @return void
     */
    public function test_pivot_relation_with_products()
    {
        $user = App\User::findOrFail(1);

        foreach ($user->products as $product) {
            $this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\Pivot::class, $product->pivot);

            switch ($product->id) {
                case 1:
                    $this->assertEquals(3, $product->pivot->quantity);
                    $this->assertEquals(2, $product->pivot->optimal_quantity);
                    break;
                case 2:
                    $this->assertEquals(1, $product->pivot->quantity);
                    $this->assertEquals(1, $product->pivot->optimal_quantity);
                    break;
                case 3:
                    $this->assertEquals(0, $product->pivot->quantity);
                    $this->assertEquals(2, $product->pivot->optimal_quantity);
                    break;
                default: break;
            }
        }
    }

    /**
     * Test get pivot by product id for stock.
     *
     * @return void
     */
    public function test_get_pivot_by_product_id()
    {
        $user = \App\User::findOrFail(1);
        $this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\Pivot::class, $user->getProductPivot(2));
        $this->assertEquals(1, $user->getProductPivot(2)->quantity);
        $this->assertEquals(1, $user->getProductPivot(2)->optimal_quantity);
        $this->assertNull($user->getProductPivot(55));
    }

    /**
     * Test user relationship with orders.
     *
     * @return void
     */
    public function test_user_has_orders()
    {
        $orders = \App\User::findOrFail(1)->orders;
        $this->assertContainsOnlyInstancesOf(\App\Order::class, $orders);
        $this->assertCount(2, $orders);

        $orders = \App\User::findOrFail(2)->orders;
        $this->assertContainsOnlyInstancesOf(\App\Order::class, $orders);
        $this->assertCount(1, $orders);
    }
}
