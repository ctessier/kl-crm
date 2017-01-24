<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerOrdersProduct extends Model
{
    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
        'consumer_order_id',
    ];

    /**
     * Returns the associated consumer's order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consumer_order()
    {
        return $this->belongsTo(ConsumerOrder::class);
    }

    /**
     * Returns the associated product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
