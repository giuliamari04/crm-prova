<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Faker\Factory as Faker;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Activity::create([
                'client_id' => $faker->numberBetween(1, 10), // Assuming you have 10 clients in the clients table
                'activity_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'subject' => $faker->sentence,
                'status' => $faker->randomElement(['attivo', 'inattivo', 'sospeso', 'in revisione']),
            ]);
        }
    }
}
