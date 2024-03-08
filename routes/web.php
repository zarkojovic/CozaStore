<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\City;
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

    //API ROUTES
    Route::post('/api/getCitiesFromCountry',
        [CityController::class, 'getCitiesFromCountry'])
        ->name('api.cities');
    Route::post('/api/addToWish',
        [ProductController::class, 'addToWish'])
        ->name('api.wish');
    Route::post('/api/getWishlistCount',
        [ProductController::class, 'getWishlistCount'])
        ->name('api.wishlist.count');
    Route::post('/api/getProductInfo',
        [ProductController::class, 'getProductInfo'])
        ->name('api.product.info');
    Route::post('/api/addToCart',
        [CartController::class, 'addToCart'])
        ->name('api.cart.add');
    // remove from cart
    Route::post('/api/removeFromCart',
        [CartController::class, 'removeFromCart'])
        ->name('api.cart.remove');
    // Make order from cart
    Route::post('/cart/order',
        [CartController::class, 'order'])
        ->name('order.store');
});

// GROUP AUTH ROUTES
Route::middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/', function() {
        return view('pages.admin.home');
    });
});

// NEUTRAL ROUTES
Route::post('/api/getProducts',
    [ProductController::class, 'getProducts'])
    ->name('api.products');

Route::get('/about', function() {
    return 1;
})->name('about');

Route::get('/services', function() {
    return 1;
})->name('services');

Route::get('/contact', [UserController::class,'sendContact'])->name('contact');

Route::get('/author', function() {
    return 1;
})->name('author');

Route::get('/test', function() {
    // retrieve products from the cart of the user
    $user = User::find(1);
    $cart = $user->carts()->where('is_ordered', 0)->first();
    $cartItems = $cart->cartItems;

    // Retrieve quantity of each product in the cart, image, price, color and size
    $products = [];
    foreach ($cartItems as $cartItem) {
        $product = $cartItem->product;
        $products[] = [
            'id' => $product->id,
            'title' => $product->title,
            'image' => $product->images()->first()->image,
            'price' => $product->price[0]->price,
            'color' => $cartItem->color->color_name,
            'size' => $cartItem->size->size_name,
            'quantity' => $cartItem->quantity,
        ];
    }

    return $products;
});
