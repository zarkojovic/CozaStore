<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            ColorSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            RoleSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            PriceSeeder::class,
            ActionSeeder::class,
        ]);
    }

}
