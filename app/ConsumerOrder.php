<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ConsumerOrder extends Model
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
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

    /**
     * Get the month attribute.
     *
     * @return \DateTime
     */
    public function getMonthAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['month']);
    }

    /**
     * Set the month attribute.
     *
     * @param $value
     *
     * @return ConsumerOrder
     */
    public function setMonthAttribute($value)
    {
        $value = Carbon::createFromFormat('m/Y', $value);
        $this->attributes['month'] = $value->format('Y-m-d');

        return $this;
    }
}
