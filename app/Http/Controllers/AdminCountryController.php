<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCountryRequest;
use App\Models\Country;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminCountryController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // select all
        $countries = Country::paginate(10);
        if ($countries->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($countries[0]->getAttributes());
        }
        return view('pages.admin.countries.home',
            ['countries' => $countries, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.admin.countries.edit',
            ['action' => 'create', 'countries' => NULL]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCountryRequest $request) {
        try {
            $country = new Country();
            $country->country_name = $request->input('country_name');
            if ($country->save()) {
                return redirect()->route('countries.index');
            }
        }
        catch (\Exception $e) {
            return redirect()
                ->route('countries.create')
                ->with('error', $e->getMessage());
        }
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
        $country = Country::find($id);
        return view('pages.admin.countries.edit',
            ['action' => 'edit', 'country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCountryRequest $request, string $id) {
        $country = Country::find($id);
        $country->country_name = $request->input('country_name');
        if ($country->save()) {
            return redirect()->route('countries.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $country = Country::find($id);
        if ($country->delete()) {
            return redirect()->route('countries.index');
        }
    }

}
