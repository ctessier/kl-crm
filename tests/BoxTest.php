<?php

class BoxTest extends TestCase
{
    /**
     * Test box quantity.
     *
     * @return void
     */
    public function test_quantity()
    {
        $box = new \App\Box(\App\BoxType::find(2));

        $box->addProduct(\App\Product::find(1), 4);
        $box->addProduct(\App\Product::find(2));

        $this->assertEquals(5, $box->getQuantity());
    }

    /**
     * Test box availability.
     *
     * @return void
     */
    public function test_availability()
    {
        $box = new \App\Box(\App\BoxType::find(1));

        $box->addProduct(\App\Product::find(16));
        $box->addProduct(\App\Product::find(17));

        $this->assertEquals(4, $box->getAvailability());
    }

    /**
     * Test box is full.
     *
     * @return void
     */
    public function test_full()
    {
        $box = new \App\Box(\App\BoxType::find(1));

        $box->addProduct(\App\Product::find(16));
        $box->addProduct(\App\Product::find(17));
        $this->assertFalse($box->isFull());

        $box->addProduct(\App\Product::find(16), 4);
        $this->assertTrue($box->isFull());
    }

    /**
     * Test box candidates.
     *
     * @return void
     */
    public function test_candidates()
    {
        $box = new \App\Box(\App\BoxType::find(1));

        $box->addProduct(\App\Product::find(16));
        $box->addProduct(\App\Product::find(17));
        $this->assertFalse($box->isFull(true));

        $box->addCandidate(\App\Product::find(17), 3);
        $box->addCandidate(\App\Product::find(17), 1);
        $this->assertFalse($box->isFull());
        $this->assertTrue($box->isFull(true));
    }
}
