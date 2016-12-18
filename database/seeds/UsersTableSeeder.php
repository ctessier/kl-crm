<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'       => 1,
                'name'     => 'John Doe',
                'email'    => 'example@example.com',
                'password' => bcrypt('secret'),
            ],
            [
                'id'       => 2,
                'name'     => 'Chuck Norris',
                'email'    => 'example2@example.com',
                'password' => bcrypt('secret'),
            ],
        ]);
    }
}
