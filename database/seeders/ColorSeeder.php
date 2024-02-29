<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $colors = [
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Black',
            'White',
            'Purple',
            'Orange',
            'Pink',
            'Brown',
        ];

        foreach ($colors as $color) {
            Color::create([
                'color_name' => $color,
            ]);
        }
    }

}
