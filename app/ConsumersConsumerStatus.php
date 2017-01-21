<?php

namespace App;

use Carbon\Carbon;
use Faker\Provider\DateTime;
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * Returns the ConsumerStatus relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(ConsumerStatus::class);
    }

    /**
     * Get the date attribute.
     * 
     * @return \DateTime
     */
    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date']);
    }

    /**
     * Set the date attribute.
     * 
     * @param $value
     * 
     * @return ConsumersConsumerStatus
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);
        
        return $this;
    }
}
