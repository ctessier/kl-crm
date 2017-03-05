<?php

use Illuminate\Database\Seeder;

class OrdersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id'        => 1,
                'user_id'   => 1,
                'reference' => 'Janvier 2017 #1',
            ],
            [
                'id'        => 2,
                'user_id'   => 1,
                'reference' => 'Février 2017 #1',
            ],
            [
                'id'        => 3,
                'user_id'   => 2,
                'reference' => 'Mars 2017 #1',
            ],
        ]);
    }
}
