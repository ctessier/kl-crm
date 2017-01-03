<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsTest extends TestCase
{
    /**
     * Test the category relationship.
     *
     * @return void
     */
    public function test_product_has_category()
    {
        $product = App\Products::findOrFail(1);
        $this->assertInstanceOf(App\Categories::class, $product->category);
        $this->assertEquals(1, $product->category->id);

        $product = App\Products::findOrFail(18);
        $this->assertEquals(3, $product->category->id);
    }
}
