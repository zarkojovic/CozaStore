<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller {

    public function show($id) {
        //         retrieve tags from product model
        $product = Product::getProductDetails($id);

        return view('pages.user.product', ['product' => $product]);
    }

    public function getProducts(Request $request) {
        $products = Product::getProducts($request, TRUE);

        return response()->json($products);
    }

    public function addToWish(Request $request) {
        $product = Product::find($request->product_id);
        $user = Session::get('authUser');
        // check if that id is already in the wishlist
        if ($user->products()
                ->where('product_id', $product->id)
                ->get()
                ->count() > 0) {
            $user->products()->detach(['product_id' => $product->id]);
            return response()->json([
                'status' => 'exists',
                'wishlistItems' => $user->products()
                    ->with(['images', 'price'])
                    ->get(),
                'numberOfProducts' => $user->products()->get()->count(),
            ]);
        }
        $user->products()->attach(['product_id' => $product->id]);

        return response()->json([
            'status' => 'success',
            'wishlistItems' => $user->products()
                ->with(['images', 'price'])
                ->get(),
            'numberOfProducts' => $user->products()->get()->count(),
        ]);
    }

    public function getWishlistCount() {
        $user = Session::get('authUser');
        $count = $user->products()->get()->count();

        return response()->json(['count' => $count]);
    }

    public function getProductInfo(Request $request) {
        $product = Product::getProductDetails($request->product_id);
        return response()->json($product);
    }

}
