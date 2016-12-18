<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumersConsumerStatus extends Model
{
    /**
     * Disable timestamps for this model.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id', 'date',
    ];

    /**
     *
     */
    public function status()
    {
        return $this->belongsTo('\App\ConsumerStatus');
    }
}
