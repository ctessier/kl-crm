<?php

use Illuminate\Database\Seeder;

class ConsumerOrdersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed consumers' orders
        DB::table('consumer_orders')->insert([
            [
                'id'          => 1,
                'consumer_id' => 1,
                'user_id'     => 1,
                'reference'   => 'KL1',
            ],
            [
                'id'          => 2,
                'consumer_id' => 2,
                'user_id'     => 1,
                'reference'   => 'KL2',
            ],
        ]);

        // Add products to the consumers' orders
        DB::table('consumer_orders_products')->insert([
            [
                'consumer_order_id' => 1,
                'product_id'        => 7,
                'quantity'          => 2,
            ],
            [
                'consumer_order_id' => 1,
                'product_id'        => 8,
                'quantity'          => 2,
            ],
            [
                'consumer_order_id' => 1,
                'product_id'        => 16,
                'quantity'          => 1,
            ],
            [
                'consumer_order_id' => 1,
                'product_id'        => 20,
                'quantity'          => 1,
            ],
            [
                'consumer_order_id' => 2,
                'product_id'        => 5,
                'quantity'          => 4,
            ],
            [
                'consumer_order_id' => 2,
                'product_id'        => 6,
                'quantity'          => 2,
            ],
        ]);
    }
}
