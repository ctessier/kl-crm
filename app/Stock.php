<?php

namespace App;

use Illuminate\Support\Collection;

class Stock
{
    /**
     * @var Collection
     */
    public $products;

    /**
     * Stock constructor.
     */
    public function __construct()
    {
        $this->products = collect([]);
    }

    /**
     * Add a product to the stock.
     *
     * @param Product $product
     * @param int     $quantity
     * @param int     $optimalQuantity
     *
     * @return StockProduct
     */
    public function addProduct(Product $product, $quantity = 0, $optimalQuantity = 0)
    {
        if ($stockProduct = $this->getStockProduct($product)) {
            $stockProduct->setQuantity($quantity);
            $stockProduct->setOptimalQuantity($optimalQuantity);
        } else {
            $stockProduct = new StockProduct($product, $quantity, $optimalQuantity);
            $this->products->push($stockProduct);
        }

        return $stockProduct;
    }

    /**
     * Get a product from the stock.
     *
     * @param Product $product
     *
     * @return StockProdcut|null
     */
    public function getStockProduct(Product $product)
    {
        foreach ($this->products as $stockProduct) {
            if ($stockProduct->getProduct()->id == $product->id) {
                return $stockProduct;
            }
        }
    }
}
