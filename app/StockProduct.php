<?php

namespace App;

class StockProduct
{
    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $optimalQuantity;

    /**
     * @var int
     */
    public $temporaryQuantity = null;

    /**
     * @var Product
     */
    private $product;

    /**
     * StockProduct constructor.
     *
     * @param Product $product
     * @param int     $quantity
     * @param int     $optimalQuantity
     */
    public function __construct(Product $product, $quantity = 0, $optimalQuantity = 0)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->optimalQuantity = $optimalQuantity;
    }

    /**
     * Get product.
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
