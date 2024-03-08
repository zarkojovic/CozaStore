<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller {

    public function getCitiesFromCountry(Request $request) {
        $countryId = $request->country_id;
        $cities = City::where('country_id', $countryId)
            ->select('city_name', 'id')
            ->get();
        return response()->json($cities);
    }

}
