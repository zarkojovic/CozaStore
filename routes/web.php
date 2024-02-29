<?php

use Illuminate\Support\Facades\Route;

use Faker\Factory as Faker;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('pages.user.home');
});

Route::get('/test', function() {
    $faker = Faker::create();
    // add provider for states and cities

    //    $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
//    $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
    //    $faker->addProvider(new \Faker\Provider\en_AU\Address($faker));
    dd($faker->state);
});
