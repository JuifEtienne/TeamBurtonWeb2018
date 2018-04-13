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

    public function createDestination(Request $request) {
 
        $destination = Destination::create($request->all());
 
        return response()->json($destination);
 
    }
 
    public function updateDestination(Request $request, $id) {
 
        $destination = Destination::find($id); 
        $destination->dateArrivee = $request->input('dateArrivee');
        $destination->dateDepart = $request->input('dateDepart');
        $destination->idVoyage = $request->input('idVoyage');
        $destination->idVille = $request->input('idVille');
        $destination->save();
 
        return response()->json($destination);
    }  
 
    public function deleteDestination($id) {

        $destination = Destination::find($id);
        $destination->delete();
 
        return response()->json('Removed successfully.');
    }
 
   
}
