<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitySeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            City::create([
                'city_name' => $faker->state,
                'country_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }

}
