<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * Return the associated category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Categories');
    }
}
