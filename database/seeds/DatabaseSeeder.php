<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ConsumerStatusesTableSeeder::class);
        $this->call(ProductsTablesSeeder::class);

        if (App::environment() !== 'production') {
            $this->call(ConsumersTableSeeder::class);
            $this->class(StockTableSeeder::class);
        }
    }
}
