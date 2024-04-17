<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interaction;
use Faker\Factory as Faker;

class InteractionsSeeder extends Seeder
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
            Interaction::create([
                'client_id' => $faker->numberBetween(1, 10), // Assuming you have 10 clients in the clients table
                'type' => $faker->randomElement(['meeting', 'call', 'email', 'presentation']),
                'description' => $faker->optional()->paragraph,
                'date_time' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
