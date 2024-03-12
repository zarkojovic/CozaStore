<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        \App\Models\User::create([
            'username' => 'admin', // 'admin' is the default username
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => 1,
            'avatar' => 'avatar.png',
        ]);
    }

}
