<?php

class ConsumerTest extends TestCase
{
    /**
     * Test consumer's current status.
     *
     * @return void
     */
    public function test_current_status_is_correct()
    {
        $consumer = \App\Consumer::find(1);
        $this->assertInstanceOf(\App\ConsumersConsumerStatus::class, $consumer->current_status);
        $this->assertEquals(\App\ConsumerStatus::PRIVILEGED_CUSTOMER, $consumer->current_status->status_id);
        $this->assertEquals(\Carbon\Carbon::createFromDate(2014, 6, 23), $consumer->current_status->date);
    }
    /**
     * Test setting a new status for a consumer.
     *
     * @return void
     */
    public function test_it_updates_current_status()
    {
        $consumer = \App\Consumer::find(1);
        $consumer->setStatus(\App\ConsumerStatus::STOPPED, '05/10/2015');
        $this->assertEquals(\App\ConsumerStatus::STOPPED, $consumer->current_status->status_id);
        $this->assertEquals('05/10/2015', $consumer->current_status->date->format('d/m/Y'));

        $consumer->setStatus(\App\ConsumerStatus::IN_BREAK, '01/04/2014');
        $this->assertEquals(\App\ConsumerStatus::STOPPED, $consumer->current_status->status_id);
        $this->assertEquals('05/10/2015', $consumer->current_status->date->format('d/m/Y'));
    }
}
