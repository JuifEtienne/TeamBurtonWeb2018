<?php

namespace App\Http\Controllers;
 
use App\Classes\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getAll() {

        $cities = City::orderBy('name')->get();

        return response()->json($cities);

    }

    public function getAllFromCountry($idCountry) {
 
        $cities = City::where('idCountry', '=', $idCountry)->orderBy('name')->get();
 
        return response()->json($cities);
 
    }

    public function getCity($id) {

        $city = City::find($id);

        return response()->json($city);
    }

    public function createCity(Request $request) {
 
        $city = City::create($request->all());
 
        return response()->json($city);
 
    }
 
    public function updateCity(Request $request, $id) {
 
        $city = City::find($id); 
        $city->name = $request->input('name');
        $city->idCountry = $request->input('idCountry');
        $city->idTimeZone = $request->input('idTimeZone');
        $city->save();
 
        return response()->json($city);
    }  
 
    public function deleteCity($id) {

        $city = City::find($id);
        $city->delete();
 
        return response()->json('Removed successfully.');
    }
 
   
}
