<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

    //

    public function addToCart(Request $request) {
        // check if the cart_item_id is passed in the request
        if ($request->cart_item_id) {
            $cartItem = User::find(Session::get('authUser')->id)
                ->carts()
                ->where('is_ordered', 0)
                ->first()
                ->cartItems()
                ->where('id', $request->cart_item_id)
                ->first();
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            Log::informationLog('User updated quantity of product'.
                Product::find($cartItem->product_id)->title.' in cart',
                Session::get('authUser')->id);
            return User::getCartItems(Session::get('authUser')->id);
        }

        $product = Product::find($request->product_id);
        $user = Session::get('authUser');
        // check if user has a cart that is not ordered
        if ($user->carts()->where('is_ordered', 0)->first() === NULL) {
            $cart = $user->carts()->create();
        }
        else {
            $cart = $user->carts()->where('is_ordered', 0)->first();
        }
        // check if the product is already in the cart
        if ($cart->cartItems()
                ->where('product_id', $product->id)
                ->where('color_id', $request->color_id)
                ->where('size_id', $request->size_id)
                ->first() !== NULL) {
            $cartItem = $cart->cartItems()
                ->where('product_id', $product->id)
                ->where('color_id', $request->color_id)
                ->where('size_id', $request->size_id)
                ->first();
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
            return [
                'cartItems' => $cart->cartItems()->count(),
                'getCartItems' => User::getCartItems($user->id),
            ];
        }
        $cart->cartItems()->create([
            'product_id' => $product->id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
        ]);
        $items = [
            'cartItems' => $cart->cartItems()->count(),
            'getCartItems' => User::getCartItems($user->id),
        ];

        Log::informationLog('User added product'.$product->title.' to cart',
            $user->id);

        return $items;
    }

    public function removeFromCart(Request $request) {
        $user = Session::get('authUser');
        $cart = $user->carts()->where('is_ordered', 0)->first();
        if ($request->input('cart_item_id')) {
            $cartItem = $cart->cartItems()
                ->where('id', $request->input('cart_item_id'))
                ->first();
            $cartItem->delete();
        }
        else {
            $cartItem = $cart->cartItems()
                ->where('product_id', $request->product_id)
                ->where('color_id', $request->color_id)
                ->where('size_id', $request->size_id)
                ->first();
            $cartItem->delete();
        }

        Log::informationLog('User removed product'.Product::find($request->product_id)
                ->first()->title.' from cart', $user->id);
        return [
            'cartItems' => $cart->cartItems()->count(),
            'getCartItems' => User::getCartItems($user->id),
        ];
    }

    public function checkout() {
        // I need to retrieve all the products in the cart of the user with image, title, price per item, quantity, color, size and total price
        $user = Session::get('authUser');
        $cart = $user->carts()->where('is_ordered', 0)->first();
        $cartItems = $cart->cartItems;
        $products = [];

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $products[] = [
                'cartitem_id' => $cartItem->id,
                // I need this to remove the item from the cart
                'id' => $product->id,
                'title' => $product->title,
                'image' => $product->images()->first()->image,
                'price' => $product->price,
                'color' => $cartItem->color->color_name,
                'size' => $cartItem->size->size_name,
                'quantity' => $cartItem->quantity,
                'color_id' => $cartItem->color->id,
                'size_id' => $cartItem->size->id,
                'total' => $cartItem->quantity * $product->price,
            ];
        }

        // I need total price of the cart from all the products
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product['total'];
        }
        $totalPrice = round($totalPrice, 2);

        return view('pages.user.checkout', [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function order() {
        $user = Session::get('authUser');
        // check if user has inserted an address and a city
        if ($user->address === NULL || $user->city_id === NULL) {
            return redirect()
                ->route('profile')
                ->with('error',
                    'Please insert your address and city to proceed with the order');
        }
        $cart = $user->carts()->where('is_ordered', 0)->first();
        $cart->is_ordered = 1;
        // get total price and insert it
        $totalPrice = 0;
        foreach ($cart->cartItems as $cartItem) {
            $product = $cartItem->product;
            $totalPrice += $product->price * $cartItem->quantity;
        }
        $cart->total = $totalPrice;
        Log::informationLog('User ordered products, order no:'.$cart->id,
            $user->id);
        $cart->save();
        return redirect()->route('profile');
    }

}
