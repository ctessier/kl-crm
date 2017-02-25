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

    /**
     * Test consumer full name.
     *
     * @return void
     */
    public function test_it_returns_right_full_name()
    {
        $consumer = \App\Consumer::find(1);
        $consumer->update([
            'first_name' => 'John',
            'last_name'  => 'Doe',
        ]);

        $this->assertEquals('John Doe', $consumer->full_name);
    }

    /**
     * Test consumer status relationship with status.
     *
     * @return void
     */
    public function test_association_table_relationship()
    {
        $consumer = \App\Consumer::find(1);

        foreach ($consumer->statuses as $consumer_status) {
            $this->assertInstanceOf(App\ConsumersConsumerStatus::class, $consumer_status);
            $this->assertInstanceOf(App\ConsumerStatus::class, $consumer_status->status);
        }
    }

    /**
     * Test consumer's status date attribute.
     *
     * @return void
     */
    public function test_consumer_status_date_attribute()
    {
        $consumer = \App\Consumer::find(1);
        $status = $consumer->current_status;
        $this->assertInstanceOf(\Carbon\Carbon::class, $status->date);
        $this->assertEquals($status->date->format('d/m/Y'), '23/06/2014');
        $status->date = '12/12/2016';
        $this->assertEquals($status->date->format('Y-m-d'), '2016-12-12');
    }
}
