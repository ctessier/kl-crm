<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Return the collection of products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Products', 'category_id');
    }
}
