<?php

namespace App\Http\Controllers;
 
use App\Classes\Destination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function getAllFromVoyage($idJourney) {
 
        $destinations = Destination::where('idJourney', '=', $idJourney)->get();
 
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
        $destination->arrivalDate = $request->input('arrivalDate');
        $destination->departureDate = $request->input('departureDate');
        $destination->idJourney = $request->input('idJourney');
        $destination->idCity = $request->input('idCity');
        $destination->save();
 
        return response()->json($destination);
    }  
 
    public function deleteDestination($id) {

        $destination = Destination::find($id);
        $destination->delete();
 
        return response()->json('Removed successfully.');
    }
 
   
}
