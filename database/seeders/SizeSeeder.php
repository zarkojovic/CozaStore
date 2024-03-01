<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $sizes = [
            ['size_name' => 'XS'],
            ['size_name' => 'SM'],
            ['size_name' => 'LG'],
            ['size_name' => 'XL'],
            ['size_name' => 'XXL'],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }

}
