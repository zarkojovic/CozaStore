<?php

use App\Http\Controllers\AuthController;
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

// GROUP GUEST ROUTES
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'checkLogin'])
        ->name('login.check');

    Route::get('/register', [AuthController::class, 'registerPage'])
        ->name('register');
    Route::post('/register', [AuthController::class, 'checkRegister'])
        ->name('register.check');

    Route::get('/forgot-password', function() {
        return view('pages.guest.forgotPassword');
    })->name('forgot-password');
});

Route::get('/', function() {
    return view('pages.user.home');
})->name('home');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/profile', function() {
    return '1';
})->name('profile');
Route::get('/admin', function() {
    return view('pages.admin.home');
});

Route::get('/test', function() {
    dd(\Illuminate\Support\Facades\Session::exists('authUser'));
    $item = \App\Models\Product::find(1);

    return $item->images;
});
