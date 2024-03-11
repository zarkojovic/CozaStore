<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCityRequest;
use App\Http\Requests\AdminCityUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminCityController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // select all cities with names of countries from the countries table
        $cities = City::join('countries', 'cities.country_id', '=',
            'countries.id')
            ->select('cities.id', 'cities.city_name', 'countries.country_name')
            ->paginate(10);
        if ($cities->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($cities[0]->getAttributes());
        }
        return view('pages.admin.cities.home',
            ['cities' => $cities, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $countries = Country::select('id', 'country_name as text')->get();

        return view('pages.admin.cities.edit',
            ['action' => 'create', 'city' => NULL, 'countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCityRequest $request) {
        try {
            $city = new City();
            $city->city_name = $request->input('city_name');
            $city->country_id = $request->input('country_id');
            if ($city->save()) {
                return redirect()->route('cities.index');
            }
        }
        catch (\Exception $e) {
            Log::errorLog('Error creating city');
            return redirect()
                ->route('cities.create')
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
        $city = City::find($id);
        $countries = Country::select('id', 'country_name as text')->get();
        return view('pages.admin.cities.edit',
            ['action' => 'edit', 'city' => $city, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCityRequest $request, string $id) {
        $city = City::findOrFail($id);
        $city->city_name = $request->input('city_name');
        $city->country_id = $request->input('country_id');
        if ($city->save()) {
            return redirect()->route('cities.index');
        }
        else {
            Log::errorLog('Error updating city');
            return redirect()
                ->route('cities.edit', $id)
                ->with('error', 'Failed to update city');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $city = City::findOrFail($id);

        if ($city->delete()) {
            return redirect()->route('cities.index');
        }
        else {
            Log::errorLog('Error deleting city');
            return redirect()
                ->back()
                ->with('error', 'Failed to delete city');
        }
    }

}
