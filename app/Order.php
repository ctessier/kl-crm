<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
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
     * Return the collection of consumer orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consumer_orders()
    {
        return $this->hasMany(ConsumerOrder::class);
    }

    /**
     * Return the collection of consumer orders products.
     *
     * @param bool $from_stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products($from_stock = false)
    {
        return $this->hasManyThrough(ConsumerOrdersProduct::class, ConsumerOrder::class)
            ->selectRaw('consumer_orders_products.product_id, sum(consumer_orders_products.quantity) as sum_quantity')
            ->join('products', 'products.id', '=', 'consumer_orders_products.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('consumer_orders_products.from_stock', $from_stock)
            ->groupBy('consumer_orders_products.product_id', 'consumer_orders.order_id')
            ->orderBy('categories.id')
            ->orderBy('sum_quantity', 'DESC');
    }
}
