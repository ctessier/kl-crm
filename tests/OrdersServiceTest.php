<?php

class OrdersServiceTest extends TestCase
{
    /**
     * @var \App\Services\OrdersService
     */
    protected $orders_service;

    /**
     * OrdersServiceTest constructor.
     */
    public function __construct()
    {
        $this->orders_service = new \App\Services\OrdersService();
    }

    /**
     * Test order total products quantity.
     *
     * @return void
     */
    public function test_total_products_quantity()
    {
        $order1 = \App\Order::find(1);
        $order2 = \App\Order::find(2);

        $this->assertEquals(9, $this->orders_service->getTotalProductsQuantity($order1));
        $this->assertEquals(3, $this->orders_service->getTotalProductsQuantity($order1, true));
        $this->assertEquals(0, $this->orders_service->getTotalProductsQuantity($order2, false));
        $this->assertEquals(0, $this->orders_service->getTotalProductsQuantity($order2, true));
    }

    /**
     * Test order quantity by product.
     *
     * @return void
     */
    public function test_quantity_by_product()
    {
        $order1 = \App\Order::find(1);
        $product5 = \App\Product::find(5);
        $product7 = \App\Product::find(7);
        $product8 = \App\Product::find(8);
        $product20 = \App\Product::find(20);

        $this->assertEquals(4, $this->orders_service->getQuantityByProduct($order1, $product5));
        $this->assertEquals(2, $this->orders_service->getQuantityByProduct($order1, $product7));
        $this->assertEquals(2, $this->orders_service->getQuantityByProduct($order1, $product8));
        $this->assertEquals(1, $this->orders_service->getQuantityByProduct($order1, $product20));
    }

    /**
     * Test order boxes.
     *
     * @return void
     */
    public function test_boxes()
    {
        $order1 = \App\Order::find(1);
        $boxes = $this->orders_service->getBoxes($order1);
        $incomplete_boxes = $this->orders_service->getBoxes($order1, true);

        $this->assertCount(3, $boxes);
        $this->assertCount(2, $incomplete_boxes);
    }

    /**
     * Test order get filler candidates.
     *
     * @return void
     */
    public function test_filler_candidates()
    {
        $stock = $this->generateStock();
        $order = \App\Order::find(1);

        //$candidates = $this->orders_service->getFillerCandidates($order, $stock);
    }

    /**
     * Generate a stock collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function generateStock()
    {
        $user = factory(App\User::class)->create();

        $quantities = [2, 0, 0, 1, 3, 2, 0, 0, 1, 1, 1, 2, 0, 0, 1, 3, 2, 0, 0, 1, 1, 1, 0];

        foreach (\App\Product::orderBy('id')->get() as $product) {
            $user->products()->attach($product->id, [
                'optimal_quantity' => 2,
                'quantity'         => $quantities[$product->id - 1],
            ]);
        }

        return $user->products;
    }
}
