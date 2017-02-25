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
                'birthdate'   => '1985-10-07',
                'sex'         => 'm',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->mobileNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 1,
            ],
            [
                'id'          => 2,
                'first_name'  => $faker->firstNameFemale,
                'last_name'   => $faker->lastName,
                'birthdate'   => '1988-06-24',
                'sex'         => 'f',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->mobileNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 1,
            ],
            [
                'id'          => 3,
                'first_name'  => $faker->firstNameMale,
                'last_name'   => $faker->lastName,
                'birthdate'   => '1990-07-03',
                'sex'         => 'm',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->mobileNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 1,
            ],
            [
                'id'          => 4,
                'first_name'  => $faker->firstNameFemale,
                'last_name'   => $faker->lastName,
                'birthdate'   => '1976-05-07',
                'sex'         => 'f',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->mobileNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 2,
            ],
            [
                'id'          => 5,
                'first_name'  => $faker->firstNameMale,
                'last_name'   => $faker->lastName,
                'birthdate'   => '1994-01-16',
                'sex'         => 'm',
                'email'       => $faker->email,
                'phone'       => str_replace(' ', '', $faker->mobileNumber),
                'address'     => $faker->streetAddress,
                'postal_code' => str_replace(' ', '', $faker->postcode),
                'city'        => $faker->city,
                'user_id'     => 2,
            ],
        ]);

        // Seed consumers statuses
        DB::table('consumers_consumer_statuses')->insert([
            [
                'consumer_id' => 1,
                'status_id'   => ConsumerStatus::TEST_PROGRAM,
                'date'        => '2014-05-03',
            ],
            [
                'consumer_id' => 1,
                'status_id'   => ConsumerStatus::PRIVILEGED_CUSTOMER,
                'date'        => '2014-06-23',
            ],
            [
                'consumer_id' => 2,
                'status_id'   => ConsumerStatus::PRIVILEGED_CUSTOMER,
                'date'        => '2010-10-30',
            ],
            [
                'consumer_id' => 3,
                'status_id'   => ConsumerStatus::TEST_PROGRAM,
                'date'        => '2016-12-05',
            ],
            [
                'consumer_id' => 4,
                'status_id'   => ConsumerStatus::TEST_PROGRAM,
                'date'        => '2016-11-29',
            ],
            [
                'consumer_id' => 5,
                'status_id'   => ConsumerStatus::STOPPED,
                'date'        => '2016-09-19',
            ],
        ]);
    }
}
