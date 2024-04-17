<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Financial;
use Faker\Factory as Faker;

class FinancialsSeeder extends Seeder
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
            Financial::create([
                'client_id' => $faker->numberBetween(1, 10), // Assuming you have 10 clients in the clients table
                'invoice_number' => $faker->unique()->uuid,
                'amount' => $faker->randomFloat(2, 100, 1000),
                'due_date' => $faker->dateTimeBetween('now', '+1 year'),
                'paid' => $faker->boolean(70), // 70% probability of being true
            ]);
        }
    }
}
