<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerOrder extends Model
{
    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
        'reference',
        'consumer_id',
    ];

    /**
     * Return the associated consumer of the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }

    /**
     * Return the products of the consumer's order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'consumer_orders_products', 'consumer_order_id', 'product_id')
            ->withPivot('quantity');
    }
}
