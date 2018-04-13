<?php

namespace App\Http\Controllers;
 
use App\Classes\Destination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function getAllFromVoyage($idVoyage) {
 
        $destinations = Destination::where('idVoyage', '=', $idVoyage)->get();
 
        return response()->json($destinations);
 
    }

    public function getDestination($id) {

        $destination = Destination::find($id);

        return response()->json($destination);
    }

    /*public function createDestination(Request $request) {
 
        $destination = Destination::create($request->all());
 
        return response()->json($destination);
 
    }
 
    public function updateDestination(Request $request, $id) {
 
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
    }*/
 
   
}
