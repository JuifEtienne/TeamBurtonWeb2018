<?php

namespace App\Http\Controllers;

use App\Classes\Voyage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function getAll() {

        $voyages = Voyage::all();

        return response()->json($voyages);

    }

    public function getVoyage($id) {

        $voyage = Voyage::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($voyage);
    }

    public function createVoyage(Request $request) {

        $voyage = Voyage::create($request->all());

        return response()->json($voyage);

    }

    public function updateVoyage(Request $request, $id) {

        $voyage = Voyage::find($id);
        $voyage->nom = $request->input('nom');
        $voyage->dateDebut = $request->input('dateDebut');
        $voyage->dateFin = $request->input('dateFin');
        $voyage->save();

        return response()->json($voyage);
    }

    public function deleteVoyage($id) {

        $voyage = Voyage::find($id);
        $voyage->delete();

        return response()->json('Removed successfully.');
    }


}

?>
