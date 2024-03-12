<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCityController;
use App\Http\Controllers\AdminColorController;
use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\AdminLogController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminSizeController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\City;
use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Session;

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

// HOME
Route::get('/', function() {
    $products = Product::getProducts();
    if (Session::get('authUser') === NULL) {
        return view('pages.user.home', ['products' => $products]);
    }

    $addedToWishList = Session::get('authUser')
        ->products()
        ->pluck('products.id')
        ->toArray();
    return view('pages.user.home',
        ['products' => $products, 'addedToWishList' => $addedToWishList]);
})->name('home');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.show');

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

// GROUP AUTH ROUTES
Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/profile',
        [UserController::class, 'profile'])
        ->name('profile');
    Route::get('/checkout',
        [CartController::class, 'checkout'])
        ->name('checkout');

    Route::post('/profile',
        [UserController::class, 'updateProfile'])
        ->name('user.profile.update');
    Route::post('/password-update',
        [UserController::class, 'updatePassword'])
        ->name('user.password.update');

    // Make order from cart
    Route::post('/cart/order',
        [CartController::class, 'order'])
        ->name('order.store');

    //API ROUTES
    // GROUP AUTH ROUTES
    Route::prefix('api')->group(function() {
        Route::post('/getCitiesFromCountry',
            [CityController::class, 'getCitiesFromCountry'])
            ->name('api.cities');
        Route::post('/addToWish',
            [ProductController::class, 'addToWish'])
            ->name('api.wish');
        Route::post('/getWishlistCount',
            [ProductController::class, 'getWishlistCount'])
            ->name('api.wishlist.count');

        Route::post('/addToCart',
            [CartController::class, 'addToCart'])
            ->name('api.cart.add');
        // remove from cart
        Route::post('/removeFromCart',
            [CartController::class, 'removeFromCart'])
            ->name('api.cart.remove');
    });
});

// GROUP AUTH ROUTES
Route::middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/', function() {
        // get usersLogins24Hours from the database in logs by searching User logged in keyword
        $usersLogins24Hours = Log::where('log_message', 'like',
            '%User logged in%')->where('created_at', '>=',
            now()->subHours(24))->count();
        // get $usersLast7Days from the database
        $usersLast7Days = User::where('created_at', '>=',
            now()->subDays(7))->count();
        // get $moneyLast7Days from the database
        $moneyLast7Days = Cart::where('is_ordered', 1)
            ->where('created_at', '>=',
                now()->subDays(7))
            ->sum('total');
        // get $mostSoldProduct from the database
        $mostSoldProduct = 1;
        // get $ordersLast7Days from the database
        $ordersLast7Days = Cart::where('is_ordered', 1)
            ->where('created_at', '>=',
                now()->subDays(7))
            ->count();

        return view('pages.admin.home', [
            'usersLogins24Hours' => $usersLogins24Hours,
            'usersLast7Days' => $usersLast7Days,
            'moneyLast7Days' => $moneyLast7Days,
            'mostSoldProduct' => $mostSoldProduct,
            'ordersLast7Days' => $ordersLast7Days,
        ]);
    })->name('admin.home');

    // Admin user routes
    Route::resource('users', AdminUserController::class);
    // Admin role routes
    Route::resource('roles', AdminRoleController::class);
    // Admin product routes
    Route::resource('products', AdminProductController::class);
    // Admin country routes
    Route::resource('countries', AdminCountryController::class);
    // Admin city routes
    Route::resource('cities', AdminCityController::class);
    // Admin order routes
    Route::resource('orders', AdminOrderController::class);
    // Admin colors routes
    Route::resource('colors', AdminColorController::class);
    // Admin sizes routes
    Route::resource('sizes', AdminSizeController::class);
    // Admin categories routes
    Route::resource('categories', AdminCategoryController::class);
    // Admin tags routes
    Route::resource('tags', AdminTagController::class);
    // Admin logs routes
    Route::resource('logs', AdminLogController::class);
});

// NEUTRAL ROUTES
// api routes
Route::post('/api/getProducts',
    [ProductController::class, 'getProducts'])
    ->name('api.products');
Route::post('/api/getProductInfo',
    [ProductController::class, 'getProductInfo'])
    ->name('api.product.info');
// subscribe to newsletter
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('api.subscribe');
// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Send contact mail
Route::post('/send-email', [ContactController::class, 'sendMail'])
    ->name('contact.email.send');

Route::get('/author', function() {
    return view('pages.user.author');
})->name('author');
