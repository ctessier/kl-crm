<?php

class UpdatePasswordTest extends TestCase
{
    public function test_it_updates_the_password()
    {
        $user = \App\User::first();
        $this->be($user);

        $new_password = str_random(8);

        $data = [
            'password'              => $new_password,
            'password_confirmation' => $new_password,
        ];

        $this->route('PUT', 'profile.password.update', $data);

        Auth::logout();

        $attempted_login = Auth::attempt([
            'email'    => $user->email,
            'password' => $new_password,
        ]);

        $this->assertTrue($attempted_login);
    }
}
