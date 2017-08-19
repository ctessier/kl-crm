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
            ->groupBy('products.id', 'consumer_orders.order_id')
            ->orderBy('categories.id')
            ->orderBy('sum_quantity', 'DESC');
    }

    public function getTotalByProduct($product)
    {
        return $this->products()->where('product_id', $product->id)->first()->sum_quantity;
    }

    /**
     * Return the total quantity of products.
     *
     * @return int
     */
    public function getTotalProductsQuantity()
    {
        $query = ConsumerOrdersProduct::selectRaw('sum(consumer_orders_products.quantity) as total')
            ->join('consumer_orders', function ($join) {
                $join->on('consumer_orders_products.consumer_order_id', '=', 'consumer_orders.id');
            })
            ->where('consumer_orders.order_id', $this->id);

        return $query->first()->total;
    }
}
