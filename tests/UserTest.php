<?php

class UserTest extends TestCase
{
    /**
     * Test user relationship with consumers.
     *
     * @return void
     */
    public function testUserConsumersRelationship()
    {
        $userConsumers = \App\User::findOrFail(1)->consumers;
        $this->assertContainsOnlyInstancesOf(\App\Consumer::class, $userConsumers);
        $this->assertCount(3, $userConsumers);

        $userConsumers = \App\User::findOrFail(2)->consumers;
        $this->assertContainsOnlyInstancesOf(\App\Consumer::class, $userConsumers);
        $this->assertCount(2, $userConsumers);
    }
}
