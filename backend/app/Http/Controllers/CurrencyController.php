<?php

namespace App\Http\Controllers;

use App\Classes\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function getAll() {

        $currencys = Currency::all();

        return response()->json($currencys);

    }

    public function getCurrency($idCurrency) {

        $currency = Currency::find($idCurrency); // find permet de récupérer un objet par sa clé primaire

        return response()->json($currency);
    }

    public function createCurrency(Request $request) {

        $currency = Currency::create($request->all());

        return response()->json("Added successfully.");

    }

    public function updateCurrency(Request $request, $idCurrency) {

        $currency = Currency::find($idCurrency);
        $currency->name = $request->input('name');
        $currency->symbol = $request->input('symbol');
        $currency->save();

        return response()->json("Updated successfully.");
    }

    public function deleteCurrency($idCurrency) {

        $currency = Currency::find($idCurrency);
        $currency->delete();

        return response()->json('Removed successfully.');
    }

    public function getCurrencyFromCountry($idCountry) {

      $currency = DB::table('currency')
          ->select('currency.idCurrency', 'currency.name', 'symbol')
          ->join('country', 'country.idCurrency', '=', 'currency.idCurrency')
          ->where('country.idCountry', '=', $idCountry)
          ->get();

      return response()->json($currency);

    }


}

?>
