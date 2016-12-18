<?php

use Illuminate\Database\Seeder;

class ConsumerStatusesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consumer_statuses')->insert([
            [
                'label' => 'Programme Test',
            ],
            [
                'label' => 'Client Privilégié',
            ],
            [
                'label' => 'Arrêté Définitivement',
            ],
            [
                'label' => 'Arrêté Temporairement',
            ],
            [
                'label' => 'Autre',
            ],
        ]);
    }
}
