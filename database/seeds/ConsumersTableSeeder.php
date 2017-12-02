<?php

use App\ConsumerStatus;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ConsumersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fr_FR');

        // Seed consumers
        DB::table('consumers')->insert([
            [
                'id'          => 1,
                'first_name'  => $faker->firstNameMale,
                'last_name'   => $faker->lastName,
                'sex'         => 'm',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->phoneNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 1,
            ],
            [
                'id'          => 2,
                'first_name'  => $faker->firstNameFemale,
                'last_name'   => $faker->lastName,
                'sex'         => 'f',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->phoneNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 1,
            ],
            [
                'id'          => 3,
                'first_name'  => $faker->firstNameMale,
                'last_name'   => $faker->lastName,
                'sex'         => 'm',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->phoneNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 1,
            ],
            [
                'id'          => 4,
                'first_name'  => $faker->firstNameFemale,
                'last_name'   => $faker->lastName,
                'sex'         => 'f',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->phoneNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 2,
            ],
            [
                'id'          => 5,
                'first_name'  => $faker->firstNameMale,
                'last_name'   => $faker->lastName,
                'sex'         => 'm',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->phoneNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 2,
            ],
        ]);

        // Seed consumers statuses
        DB::table('consumers_consumer_statuses')->insert([
            [
                'consumer_id'       => 1,
                'status_id'         => ConsumerStatus::TEST_PROGRAM,
                'date'              => '2015-10-04',
                'membership_number' => null,
                'main_consumer_id'  => null,
                'break'             => null,
            ],
            [
                'consumer_id'       => 1,
                'status_id'         => ConsumerStatus::MAIN_MEMBER,
                'date'              => '2016-01-01',
                'membership_number' => $faker->randomNumber(8),
                'main_consumer_id'  => null,
                'break'             => false,
            ],
            [
                'consumer_id'       => 2,
                'status_id'         => ConsumerStatus::MAIN_MEMBER,
                'date'              => $faker->date(),
                'membership_number' => $faker->randomNumber(8),
                'main_consumer_id'  => null,
                'break'             => true,
            ],
            [
                'consumer_id'       => 3,
                'status_id'         => ConsumerStatus::TEST_PROGRAM,
                'date'              => $faker->date(),
                'membership_number' => null,
                'main_consumer_id'  => null,
                'break'             => null,
            ],
            [
                'consumer_id'       => 4,
                'status_id'         => ConsumerStatus::DEPENDANT_MEMBER,
                'date'              => $faker->date(),
                'membership_number' => null,
                'main_consumer_id'  => 2,
                'break'             => false,
            ],
            [
                'consumer_id'       => 5,
                'status_id'         => ConsumerStatus::STOPPED,
                'date'              => $faker->date(),
                'membership_number' => null,
                'main_consumer_id'  => null,
                'break'             => null,
            ],
        ]);
    }
}
