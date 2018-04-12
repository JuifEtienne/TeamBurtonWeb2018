<?php

namespace App\Http\Controllers;

use App\Classes\Objet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObjetController extends Controller
{
    public function getAll() {

        $objets = Objet::all();

        return response()->json($objets);

    }

    public function getObjet($id) {

        $objet = Objet::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($objet);
    }

    public function createObjet(Request $request) {

        $objet = Objet::create($request->all());

        return response()->json($objet);

    }

    public function updateObjet(Request $request, $id) {

        $objet = Objet::find($id);
        $objet->nom = $request->input('nom');
        $objet->quantite = $request->input('quantite');
        $objet->idCategorie = $request->input('idCategorie');
        $objet->save();

        return response()->json($objet);
    }

    public function deleteObjet($id) {

        $objet = Objet::find($id);
        $objet->delete();

        return response()->json('Removed successfully.');
    }


}

?>
