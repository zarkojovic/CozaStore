<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductImageSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        for ($i = 1; $i < 11; $i++) {
            ProductImage::create([
                'product_id' => $i,
                'image' => $faker->imageUrl(640, 480, 'animals', TRUE),
            ]);
        }
    }

}