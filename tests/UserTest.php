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

        foreach ($user->products as $product)
        {
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
}
