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
                'id'    => ConsumerStatus::MAIN_MEMBER,
                'label' => 'Adhérent principal',
            ],
            [
                'id'    => ConsumerStatus::DEPENDANT_MEMBER,
                'label' => 'Adhérent rattaché',
            ],
            [
                'id'    => ConsumerStatus::STOPPED,
                'label' => 'A arrêté la consommation',
            ],
        ]);
    }
}
