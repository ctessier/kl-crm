<?php

class ProductsTest extends TestCase
{
    /**
     * Test the category relationship.
     *
     * @return void
     */
    public function test_product_has_category()
    {
        $product = App\Product::findOrFail(1);
        $this->assertInstanceOf(App\Category::class, $product->category);
        $this->assertEquals(1, $product->category->id);

        $product = App\Product::findOrFail(18);
        $this->assertEquals(3, $product->category->id);
    }
}
