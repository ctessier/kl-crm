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
        $this->assertEquals(\App\ConsumerStatus::MAIN_MEMBER, $consumer->current_status->status_id);
        $this->assertEquals(\Carbon\Carbon::createFromDate(2016, 1, 1), $consumer->current_status->date);
    }

    /**
     * Test setting a new status for a consumer.
     *
     * @return void
     */
    public function test_it_updates_current_status()
    {
        $consumer = \App\Consumer::find(1);
        $consumerData = $consumer->toArray();
        $this->be(\App\User::find(1));

        $newData = [
            'status_id' => \App\ConsumerStatus::MAIN_MEMBER,
            'break' => true,
            'membership_number' => '123456789',
            'date' => '07/10/2017',
            'main_consumer_id' => null,
        ];

        $consumerData['status_id'] = $newData['status_id'];
        $consumerData['break'] = $newData['break'];
        $consumerData['membership_number'] = $newData['membership_number'];
        $consumerData['date'] = $newData['date'];

        $this->put('/consumers/1', $consumerData)->assertResponseStatus(302);
        $this->assertEquals($newData['status_id'], $consumer->current_status->status_id);
        $this->assertEquals($newData['date'], $consumer->current_status->date->format('d/m/Y'));
        $this->assertEquals($newData['membership_number'], $consumer->current_status->membership_number);
        $this->assertEquals($newData['break'], $consumer->current_status->break);

        $nbStatuses = $consumer->statuses->count();

        $newData['status_id'] = \App\ConsumerStatus::DEPENDANT_MEMBER;
        $newData['main_consumer_id'] = 1;
        $newData['date'] = '07/11/2017';

        $consumerData['status_id'] = $newData['status_id'];
        $consumerData['main_consumer_id'] = $newData['main_consumer_id'];
        $consumerData['date'] = $newData['date'];

        $this->put('/consumers/1', $consumerData)->assertResponseStatus(302);
        $this->assertEquals($newData['status_id'], $consumer->current_status->status_id);
        $this->assertEquals($newData['date'], $consumer->current_status->date->format('d/m/Y'));
        $this->assertEquals($newData['main_consumer_id'], $consumer->current_status->main_consumer_id);
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
        $this->assertEquals($status->date->format('d/m/Y'), '01/01/2016');
        $status->date = '12/12/2016';
        $this->assertEquals($status->date->format('Y-m-d'), '2016-12-12');
    }
}
