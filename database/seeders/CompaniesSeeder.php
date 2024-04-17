<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Faker\Factory as Faker;

class CompaniesSeeder extends Seeder
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
            Company::create([
                'client_id' => $faker->numberBetween(1, 10), // Assuming you have 10 clients in the clients table
                'name' => $faker->company,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'industry' => $faker->word,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'postal_code' => $faker->postcode,
                'province' => $faker->stateAbbr,
                'country' => $faker->country,
                'website' => $faker->optional()->url,
                'status' => $faker->randomElement(['potenziale', 'attivo', 'ex']),
            ]);
        }
    }
}
