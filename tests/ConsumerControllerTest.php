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
        $response = $this->route('GET', 'consumers.edit', ['consumers' => 1]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
