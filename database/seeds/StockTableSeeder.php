<?php

use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_products')->insert([
            [
                'product_id'       => 1,
                'user_id'          => 1,
                'quantity'         => 3,
                'optimal_quantity' => 2,
            ],
            [
                'product_id'       => 2,
                'user_id'          => 1,
                'quantity'         => 1,
                'optimal_quantity' => 1,
            ],
            [
                'product_id'       => 3,
                'user_id'          => 1,
                'quantity'         => 0,
                'optimal_quantity' => 2,
            ],
            [
                'product_id'       => 2,
                'user_id'          => 2,
                'quantity'         => 4,
                'optimal_quantity' => 5,
            ],
            [
                'product_id'       => 5,
                'user_id'          => 2,
                'quantity'         => 1,
                'optimal_quantity' => 2,
            ],
            [
                'product_id'       => 6,
                'user_id'          => 2,
                'quantity'         => 0,
                'optimal_quantity' => 0,
            ],
            [
                'product_id'       => 8,
                'user_id'          => 2,
                'quantity'         => 2,
                'optimal_quantity' => 2,
            ],
        ]);
    }
}
