<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ConsumersConsumerStatus extends Model
{
    /**
     * Disable timestamps for this model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['consumer_id'];

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
        $value = Carbon::createFromFormat('d/m/Y', $value);
        $this->attributes['date'] = $value->format('Y-m-d');

        return $this;
    }

    /**
     * Set the main_consumer_id attribute (to null if empty).
     *
     * @param $value
     */
    public function setMainConsumerIdAttribute($value)
    {
        $this->attributes['main_consumer_id'] = trim($value) !== '' ? $value : null;
    }

    /**
     * Returns the Consumer relation (for dependant members).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function main_consumer()
    {
        return $this->belongsTo(Consumer::class, 'main_consumer_id');
    }
}
