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
                'order_id'    => 1,
                'consumer_id' => 1,
                'user_id'     => 1,
                'reference'   => 'KL1',
                'month'       => '2017-01-01',
            ],
            [
                'id'          => 2,
                'order_id'    => 1,
                'consumer_id' => 2,
                'user_id'     => 1,
                'reference'   => 'KL2',
                'month'       => '2016-12-01',
            ],
        ]);

        // Add products to the consumers' orders
        DB::table('consumer_orders_products')->insert([
            [
                'consumer_order_id' => 1,
                'product_id'        => 7,
                'quantity'          => 2,
                'from_stock'        => false,
            ],
            [
                'consumer_order_id' => 1,
                'product_id'        => 8,
                'quantity'          => 2,
                'from_stock'        => false,
            ],
            [
                'consumer_order_id' => 1,
                'product_id'        => 16,
                'quantity'          => 1,
                'from_stock'        => true,
            ],
            [
                'consumer_order_id' => 1,
                'product_id'        => 20,
                'quantity'          => 1,
                'from_stock'        => false,
            ],
            [
                'consumer_order_id' => 2,
                'product_id'        => 5,
                'quantity'          => 4,
                'from_stock'        => false,
            ],
            [
                'consumer_order_id' => 2,
                'product_id'        => 6,
                'quantity'          => 2,
                'from_stock'        => true,
            ],
        ]);
    }
}
