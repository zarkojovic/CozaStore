<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Get all orders with usernames of the users who ordered

        $orders = Cart::where('is_ordered', 1)
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->select('carts.id', 'users.avatar', 'users.username',
                DB::raw("CONCAT('$', carts.total) AS total"),

                'carts.created_at as order_date')
            ->paginate(10);

        if ($orders->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($orders[0]->getAttributes());
        }
        return view('pages.admin.orders.home',
            ['orders' => $orders, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $order = Cart::where('carts.id', $id)
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->select('carts.id', 'users.avatar', 'users.username',
                'carts.user_id', 'carts.created_at',
                DB::raw("CONCAT('$', carts.total) AS total"),
                'carts.created_at as order_date')
            ->first();

        return view('pages.admin.orders.edit',
            ['action' => 'edit', 'order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

}
