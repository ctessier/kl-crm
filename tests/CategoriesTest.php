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
        $category = App\Categories::findOrFail(1);
        $this->assertContainsOnlyInstancesOf(App\Products::class, $category->products);
        $this->assertCount(9, $category->products);
    }
}
