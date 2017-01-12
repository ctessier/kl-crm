<?php

class CategoriesTest extends TestCase
{
    /**
     * Test the products relationship.
     *
     * @return void
     */
    public function test_category_has_products()
    {
        $category = App\Category::findOrFail(1);
        $this->assertContainsOnlyInstancesOf(App\Product::class, $category->products);
        $this->assertCount(8, $category->products);
    }
}
