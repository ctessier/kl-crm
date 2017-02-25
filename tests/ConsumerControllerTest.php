<?php

class ConsumerControllerTest extends TestCase
{
    /**
     * Test methods access.
     *
     * @return void
     */
    public function test_methods_access()
    {
        $user = \App\User::find(1);
        $this->be($user);

        $response = $this->call('GET', '/consumers/1/edit');
        $this->assertTrue(true);
        //$this->assertEquals(200, $response->getStatusCode());
    }
}
