<?php

class ProfileControllerTest extends TestCase
{
    /**
     * Test user profile updating.
     *
     * @return void
     */
    public function test_it_updates_user_profile()
    {
        $user = \App\User::first();
        $this->be($user);

        $data = [
            'name'  => 'Clark Kent',
            'email' => 'clark@kent.com',
        ];

        $this->route('PUT', 'profile.update', $data);

        $this->assertRedirectedToRoute('profile.show');
        $this->seeInDatabase('users', ['name' => 'Clark Kent']);
        $this->seeInDatabase('users', ['email' => 'clark@kent.com']);
    }
}
