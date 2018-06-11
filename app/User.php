<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
     * @var Stock
     */
    private $stock = null;

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

    /*
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
     * Return the orders of the user.
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Collection
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Return associated products (stock) thanks to pivot table.
     *
     * @return Product[]|Illuminate\Database\Eloquent\Collection
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

    /**
     * Return the user's stock.
     *
     * @return Stock
     */
    public function getStock()
    {
        if (!$this->stock) {
            $this->stock = new Stock();
            foreach ($this->products as $product) {
                $this->stock->addProduct(
                    $product,
                    $product->pivot->quantity,
                    $product->pivot->optimal_quantity
                );
            }
        }

        return $this->stock;
    }
}
