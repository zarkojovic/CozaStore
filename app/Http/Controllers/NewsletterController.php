<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller {

    public function subscribe(Request $request): \Illuminate\Http\JsonResponse {
        $request->validate([
            'email' => 'required|email',
        ]);
        // check if already subscribed
        $isSubscribed = Newsletter::where('email', $request->email)->first();
        if (!$isSubscribed) {
            Newsletter::insert(['email' => $request->email]);
        }
        return response()->json(['message' => 'You have successfully subscribed to our newsletter!']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // get newsletters with username and name of action

        $newsletters = Newsletter::paginate(10);
        if ($newsletters->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($newsletters[0]->getAttributes());
        }
        return view('pages.admin.newsletters.home',
            ['newsletters' => $newsletters, 'columns' => $columns]);
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
        //
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
    public function destroy(string $id) {}

}
