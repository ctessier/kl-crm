<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
        'user_id'
    ];

    /**
     * Set a new status for the consumer.
     *
     * @param int    $status
     * @param string $date
     *
     * @return boolean
     */
    public function setStatus($status, $date)
    {
        $consumers_consumer_status = $this->current_status;

        if ($consumers_consumer_status === null || $consumers_consumer_status->status_id != $status) {
            $consumers_consumer_status = new ConsumersConsumerStatus();
            $consumers_consumer_status->consumer_id = $this->id;
            $consumers_consumer_status->status_id = $status;
        }

        $consumers_consumer_status->date = $date;

        return $consumers_consumer_status->save();
    }

    /**
     * Return consumer's current status (latest status).
     *
     * @return \App\ConsumerStatus
     */
    public function getCurrentStatusAttribute()
    {
        return ConsumersConsumerStatus::where('consumer_id', $this->id)
            ->orderBy('date', 'DESC')
            ->first();
    }
}
