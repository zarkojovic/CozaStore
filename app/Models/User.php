<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getCartItems($id) {
        $user = User::find($id);

        $cart = $user->carts()->where('is_ordered', 0)->first();
        if ($cart === NULL) {
            return [
            ];
        }
        $cartItems = $cart->cartItems;

        // Retrieve quantity of each product in the cart, image, price, color and size
        $products = [];
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $products[] = [
                'id' => $product->id,
                'cartitem_id' => $cartItem->id,
                'title' => $product->title,
                'image' => $product->images()->first()->image,
                'price' => $product->price,
                'color' => $cartItem->color->color_name,
                'size' => $cartItem->size->size_name,
                'color_id' => $cartItem->color->id,
                'size_id' => $cartItem->size->id,
                'quantity' => $cartItem->quantity,
                'total' => $product->price * $cartItem->quantity,
            ];
        }

        // calculate total price of the cart
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }
        // round on 2 decimal places
        $totalPrice = round($totalPrice, 2);

        return [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ];
    }

    /**
     * User Relationships
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'liked_products', 'user_id',
            'product_id');
    }

    public function city() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

}
