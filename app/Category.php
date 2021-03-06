<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Return the associated box type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function box_type()
    {
        return $this->belongsTo(BoxType::class);
    }

    /**
     * Return the collection of products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
