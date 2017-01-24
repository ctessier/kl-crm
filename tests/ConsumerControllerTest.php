<?php

class ConsumerControllerTest extends TestCase
{
    /**
     * Test methods access
     *
     * @return void
     */
    public function test_methods_access()
    {
        $this->be(\App\User::find(1));

        $response = $this->call('GET', '/consumers/1/edit/');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
