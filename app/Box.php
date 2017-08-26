<?php

namespace App;

use Illuminate\Support\Collection;

class Box
{
    /**
     * @var BoxType
     */
    private $type;

    /**
     * @var int
     */
    private $capacity;

    /**
     * @var Product[]|Collection
     */
    private $content;

    /**
     * Box constructor.
     *
     * @param BoxType $box_type
     */
    public function __construct(BoxType $box_type)
    {
        $this->type = $box_type;
        $this->capacity = $box_type->capacity;
        $this->content = new Collection();
    }

    /**
     * Add a given product to the box.
     * A quantity can be given.
     *
     * @param Product $product
     * @param int     $quantity
     *
     * @return int Number of product which could not be placed.
     */
    public function addProduct(Product $product, $quantity = 1)
    {
        if ($this->isFull()) {
            return $quantity;
        }

        while ($quantity-- > 0) {
            $this->content->push($product);

            // we return the quantity left if the box reached its full capacity
            if ($this->getQuantity() === $this->capacity) {
                return $quantity;
            }
        }

        return 0;
    }

    /**
     * Return the number of slots used in the box.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->content->count();
    }

    /**
     * Return the number of free slots in the box.
     *
     * @return int
     */
    public function getAvailability()
    {
        return $this->capacity - $this->getQuantity();
    }

    /**
     * Tell if the box is full or not.
     *
     * @return bool
     */
    public function isFull()
    {
        return $this->capacity === $this->getQuantity();
    }
}
