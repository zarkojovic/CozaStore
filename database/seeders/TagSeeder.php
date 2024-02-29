<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $tags = [
            ['tag_name' => 'Fashion'],
            ['tag_name' => 'Trendy'],
            ['tag_name' => 'Casual'],
            ['tag_name' => 'Formal'],
            ['tag_name' => 'Streetwear'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }

}
