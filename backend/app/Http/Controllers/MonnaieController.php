<?php

namespace App\Http\Controllers;

use App\Classes\Monnaie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonnaieController extends Controller
{
    public function getAll() {

        $monnaies = Monnaie::all();

        return response()->json($monnaies);

    }

    public function getMonnaie($id) {

        $monnaie = Monnaie::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($monnaie);
    }

    public function createMonnaie(Request $request) {

        $monnaie = Monnaie::create($request->all());

        return response()->json($monnaie);

    }

    public function updateMonnaie(Request $request, $id) {

        $monnaie = Monnaie::find($id);
        $monnaie->nom = $request->input('nom');
        $monnaie->symbole = $request->input('symbole');
        $monnaie->save();

        return response()->json($monnaie);
    }

    public function deleteMonnaie($id) {

        $monnaie = Monnaie::find($id);
        $monnaie->delete();

        return response()->json('Removed successfully.');
    }


}

?>
