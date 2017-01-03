<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function consumers()
    {
        return $this->hasMany('App\Consumer')
            ->orderBy('last_name')
            ->orderBy('first_name');
    }

    /**
     * Return associated products (stock) thanks to pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Products', 'user_products', 'user_id', 'product_id')
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

        return null;
    }
}
