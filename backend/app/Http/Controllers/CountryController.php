<?php

namespace App\Http\Controllers;

use App\Classes\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getAll() {

        $countries = Country::all();

        return response()->json($countries);

    }

    public function getCountry($id) {

        $country = Country::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($country);
    }

}

?>
