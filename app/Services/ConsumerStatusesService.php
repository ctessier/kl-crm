<?php

namespace App\Services;

use App\Consumer;
use App\ConsumersConsumerStatus;
use App\ConsumerStatus;
use App\Http\Requests\ConsumerRequest;

class ConsumerStatusesService
{
    /**
     * @var array List of status fields names from request.
     */
    protected $fields = [
        'date',
        'status_id',
        'membership_number',
        'main_consumer_id',
        'break',
    ];

    /**
     * Return the list of status fields names.
     *
     * @return array
     */
    public function getStatusFields()
    {
        return $this->fields;
    }

    /**
     * Populate a given consumer status from a request.
     *
     * @param ConsumersConsumerStatus $consumerStatus
     * @param ConsumerRequest         $request
     *
     * @return ConsumersConsumerStatus
     */
    public function populate(ConsumersConsumerStatus $consumerStatus, ConsumerRequest $request)
    {
        $consumerStatus->fill($request->only($this->fields));

        if ($consumerStatus->status_id != ConsumerStatus::MAIN_MEMBER) {
            $consumerStatus->membership_number = null;
            $consumerStatus->break = null;
        }

        if ($consumerStatus->status_id != ConsumerStatus::DEPENDANT_MEMBER) {
            $consumerStatus->main_consumer_id = null;
        }

        return $consumerStatus;
    }

    /**
     * @param Consumer        $consumer
     * @param ConsumerRequest $request
     *
     * @return ConsumersConsumerStatus
     */
    public function setConsumerStatus(Consumer $consumer, ConsumerRequest $request)
    {
        $consumer_status = $consumer->current_status;

        /* Create a new status if :
         * - there is a not current status, or
         * - the status is different, or
         * - the status is MAIN_MEMBER and the break value has changed
         */
        if ($consumer_status === null ||
            $consumer_status->status_id != $request->get('status_id') ||
            ($consumer_status->status_id == ConsumerStatus::MAIN_MEMBER && $consumer_status->break != $request->get('break'))) {
            $consumer_status = new ConsumersConsumerStatus();
            $consumer_status->consumer_id = $consumer->id;
        }

        $consumer_status = $this->populate($consumer_status, $request);

        return $consumer_status;
    }
}
