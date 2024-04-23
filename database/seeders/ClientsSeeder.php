<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creare un'istanza di Faker
        $faker = Faker::create();

        // Ciclo per generare dati per ogni cliente
        for ($i = 0; $i < 10; $i++) {
            Client::create([
                'company_id' => $faker->numberBetween(1, 10),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'industry' => $faker->word,
                'p_iva' => $faker->optional()->numerify('###########'),
                'codice_fiscale' => $faker->unique()->numerify('###############'),
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'postal_code' => $faker->postcode,
                'province' => $faker->stateAbbr,
                'country' => $faker->country,
                'status' => $faker->randomElement(['potenziale', 'attivo', 'ex']),
                'contract_start_date' => $faker->optional()->date(),
                'contract_end_date' => $faker->optional()->date(),
            ]);
        }
    }
}
