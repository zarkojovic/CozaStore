<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->title = $faker->name;
            $product->description = $faker->text;
            $product->category_id = $faker->numberBetween(1, 9);
            $product->save();

            $product->sizes()->sync($faker->randomElements([1, 2, 3, 4, 5],
                $faker->numberBetween(1, 5)));
            $product->colors()->sync($faker->randomElements([1, 2, 3, 4, 5],
                $faker->numberBetween(1, 5)));
            $product->tags()->sync($faker->randomElements([1, 2, 3, 4, 5],
                $faker->numberBetween(1, 5)));
        }
    }

}
