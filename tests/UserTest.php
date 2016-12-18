<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserConsumersRelationship()
    {
        $userConsumers = $user->consumers;
        $this->assertContainsOnlyInstancesOf($userConsumers, \App\Consumer::class);
        $this->assertCount(3, $userConsumers);
    }
}
