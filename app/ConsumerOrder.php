<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsumerOrder extends Model
{
    use SoftDeletes;

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
     * Return the associated order of the consumer order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Return the products of the consumer's order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'consumer_orders_products',
            'consumer_order_id',
            'product_id'
        )->withPivot('quantity', 'from_stock');
    }

    /**
     * @param Product $product
     * @param bool    $exclude_stock
     *
     * @return int|string
     */
    public function getProductQuantity($product, $exclude_stock = true)
    {
        $quantity = $this->products()->where('product_id', $product->id)->sum('quantity');

        if ($exclude_stock) {
            $quantity -= $this->products()->where('from_stock', true)->where('product_id', $product->id)->sum('quantity');
        }

        return 0 === $quantity ? '' : $quantity;
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
        $value = Carbon::createFromFormat('d/m/Y', '01/'.$value);
        $this->attributes['month'] = $value->format('Y-m-d');

        return $this;
    }

    /**
     * Set the order_id attribute (to null if empty).
     *
     * @param $value
     */
    public function setOrderIdAttribute($value)
    {
        $this->attributes['order_id'] = trim($value) !== '' ? $value : null;
    }

    /**
     * Set the consumer_id attribute (to null if empty).
     *
     * @param $value
     */
    public function setConsumerIdAttribute($value)
    {
        $this->attributes['consumer_id'] = trim($value) !== '' ? $value : null;
    }

    /**
     * Scope a query to only include consumer orders with a consumer.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithConsumer($query)
    {
        return $query->has('consumer');
    }
}
