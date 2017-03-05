<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
        'user_id',
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
     * Return the collection of consumer orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consumer_orders()
    {
        return $this->hasMany(ConsumerOrder::class);
    }
}
