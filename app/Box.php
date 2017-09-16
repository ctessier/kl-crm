<?php

namespace App;

use Illuminate\Support\Collection;

class Box
{
    /**
     * @var BoxType
     */
    public $type;

    /**
     * @var Candidate[]|Collection
     */
    public $candidates;

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
        $this->candidates = new Collection();
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
     * Add a filler candidate to the box.
     *
     * @param Product $product
     * @param int     $quantity
     *
     * @return bool
     */
    public function addCandidate(Product $product, $quantity = 1)
    {
        if ($this->isFull(true)) {
            return false;
        }

        $candidate = $this->candidates->where('product', $product);

        if ($candidate->isNotEmpty()) {
            $candidate->first()->increment($quantity);
        } else {
            $candidate = new Candidate($product, $quantity);
            $this->candidates->push($candidate);
        }

        return $candidate;
    }

    /**
     * Return the number of slots used in the box.
     *
     * @param bool $with_candidate
     *
     * @return int
     */
    public function getQuantity($with_candidate = false)
    {
        $quantity = 0;
        if ($with_candidate) {
            $quantity = $this->candidates->sum(function ($candidate) {
                return $candidate->quantity;
            });
        }

        return $quantity + $this->content->count();
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
     * @param bool $with_candidates
     *
     * @return bool
     */
    public function isFull($with_candidates = false)
    {
        return $this->capacity == $this->getQuantity($with_candidates);
    }
}
