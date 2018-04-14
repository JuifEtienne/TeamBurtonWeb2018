<?php

namespace App\Http\Controllers;
 
use App\Classes\Ville;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function getAll() {

        $villes = Ville::all();

        return response()->json($villes);

    }

    public function getAllFromPays($idPays) {
 
        $villes = Ville::where('idPays', '=', $idPays)->get();
 
        return response()->json($villes);
 
    }

    public function getVille($id) {

        $ville = Ville::find($id);

        return response()->json($ville);
    }

    public function createVille(Request $request) {
 
        $ville = Ville::create($request->all());
 
        return response()->json($ville);
 
    }
 
    public function updateVille(Request $request, $id) {
 
        $ville = Ville::find($id); 
        $ville->nom = $request->input('nom');
        $ville->idPays = $request->input('idPays');
        $ville->idFuseau = $request->input('idFuseau');
        $ville->save();
 
        return response()->json($ville);
    }  
 
    public function deleteVille($id) {

        $ville = Ville::find($id);
        $ville->delete();
 
        return response()->json('Removed successfully.');
    }
 
   
}
