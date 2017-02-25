<?php

use App\ConsumerStatus;
use Illuminate\Database\Seeder;

class ConsumerStatusesTableSeeder extends Seeder
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
                'id'    => ConsumerStatus::TEST_PROGRAM,
                'label' => 'Programme Test',
            ],
            [
                'id'    => ConsumerStatus::PRIVILEGED_CUSTOMER,
                'label' => 'Client Privilégié',
            ],
            [
                'id'    => ConsumerStatus::STOPPED,
                'label' => 'A arrêté la consommation',
            ],
            [
                'id'    => ConsumerStatus::IN_BREAK,
                'label' => 'A arrêté temporairement',
            ],
            [
                'id'    => ConsumerStatus::OTHER,
                'label' => 'Autre',
            ],
        ]);
    }
}
