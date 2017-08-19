<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the consumers of the user ordered by last name, then first name.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Consumer[]
     */
    public function consumers()
    {
        return $this->hasMany(Consumer::class)
            ->orderBy('last_name')
            ->orderBy('first_name');
    }

    /**
     * Return the consumer orders of the user ordered by month descending.
     *
     * @return \Illuminate\Database\Eloquent\Collection|ConsumerOrder[]
     */
    public function consumer_orders()
    {
        return $this->hasMany(ConsumerOrder::class)
            ->orderBy('month', 'DESC');
    }

    /**
     * Return associated products (stock) thanks to pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'user_products', 'user_id', 'product_id')
            ->withPivot('quantity', 'optimal_quantity');
    }

    /**
     * Return an entry from the products pivot tables from a given product id.
     *
     * @param int $product_id
     *
     * @return \Illuminate\Database\Eloquent\Relations\Pivot
     */
    public function getProductPivot($product_id)
    {
        $product = $this->products()->where('product_id', $product_id)->first();

        if ($product) {
            return $product->pivot;
        }
    }
}
