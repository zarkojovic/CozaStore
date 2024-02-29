<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $countries = [
            ['country_name' => 'USA'],
            ['country_name' => 'UK'],
            ['country_name' => 'Australia'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }

}
