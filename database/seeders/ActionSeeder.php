<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $actions = [
            'information',
            'warning',
            'error',
        ];

        foreach ($actions as $action) {
            \App\Models\Action::create([
                'action_name' => $action,
            ]);
        }
    }

}
