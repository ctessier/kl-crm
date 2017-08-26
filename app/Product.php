<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Return the associated category.
     *
     * @return Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BoxType
     */
    public function getBoxType()
    {
        return $this->category->box_type;
    }
}
