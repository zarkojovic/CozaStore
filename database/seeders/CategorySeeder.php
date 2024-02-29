<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $categories = [
            ['category_name' => 'Men'],
            ['category_name' => 'Women'],
            ['category_name' => 'Kids'],
            ['category_name' => 'Accessories'],
            ['category_name' => 'Shoes'],
            ['category_name' => 'Bags'],
            ['category_name' => 'Watches'],
            ['category_name' => 'Jewelry'],
            ['category_name' => 'Sunglasses'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }

}
