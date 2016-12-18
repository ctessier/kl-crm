<?php

class ConsumerTest extends TestCase
{
    /**
     * Test consumer's current status.
     *
     * @return void
     */
    public function testCurrentStatus()
    {
        $consumer = \App\Consumer::find(1);
        $this->assertInstanceOf(\App\ConsumersConsumerStatus::class, $consumer->current_status);
        $this->assertEquals(\App\ConsumerStatus::PRIVILEGED_CUSTOMER, $consumer->current_status->status_id);
        $this->assertEquals('2014-06-23', $consumer->current_status->date);
    }
    /**
     * Test setting a new status for a consumer.
     *
     * @return void
     */
    public function testSetStatus()
    {
        $consumer = \App\Consumer::find(1);
        $consumer->setStatus(\App\ConsumerStatus::STOPPED, '2015-10-05');
        $this->assertEquals(\App\ConsumerStatus::STOPPED, $consumer->current_status->status_id);
        $this->assertEquals('2015-10-05', $consumer->current_status->date);

        $consumer->setStatus(\App\ConsumerStatus::IN_BREAK, '2015-04-01');
        $this->assertEquals(\App\ConsumerStatus::STOPPED, $consumer->current_status->status_id);
        $this->assertEquals('2015-10-05', $consumer->current_status->date);
    }
}
