<?php

namespace App;

class Candidate
{
    /**
     * @var Product
     */
    public $product;

    /**
     * @var int
     */
    public $quantity;

    /**
     * Candidate constructor.
     *
     * @param Product $product
     * @param int     $quantity
     */
    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * Increment the candidate's product quantity.
     *
     * @param int $amount
     *
     * @return int
     */
    public function increment($amount = 1)
    {
        return $this->quantity += $amount;
    }
}
