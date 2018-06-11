<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
        'user_id',
    ];

    /**
     * Return the collection of statuses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function statuses()
    {
        return $this->hasMany(ConsumersConsumerStatus::class);
    }

    /**
     * Return consumer's current status (latest status).
     *
     * @return \App\ConsumersConsumerStatus
     */
    public function getCurrentStatusAttribute()
    {
        return ConsumersConsumerStatus::where('consumer_id', $this->id)
            ->orderBy('date', 'DESC')
            ->first();
    }

    /**
     * Return consumer's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function __toString()
    {
        return $this->full_name;
    }
}
