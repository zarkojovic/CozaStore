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

        for ($i = 1; $i < 41; $i++) {
            ProductImage::create([
                'product_id' => $i,
                'image' => $i < 10 ? 'product-'.'0'.$i.'.jpg' : 'product-'.$i.'.jpg',
            ]);
            if ($i == 21) {
                ProductImage::create([
                    'product_id' => $i,
                    'image' => 'product-21a.jpg',
                ]);
                ProductImage::create([
                    'product_id' => $i,
                    'image' => 'product-21b.jpg',
                ]);
            }
        }
    }

}
