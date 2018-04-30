<?php

namespace App\Http\Controllers;

use App\Classes\Journey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    public function getAll() {

        $journeys = Journey::all();

        return response()->json($journeys);

    }

    public function getJourney($id) {

        $journey = Journey::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($journey);
    }

    public function createJourney(Request $request) {

        $journey = Journey::create($request->all());

        return response()->json($journey);

    }

    public function updateJourney(Request $request, $id) {

        $journey = Journey::find($id);
        $journey->name = $request->input('name');
        $journey->startingDate = $request->input('startingDate');
        $journey->endingDate = $request->input('endingDate');
        $journey->save();

        return response()->json($journey);
    }

    public function deleteJourney($id) {

        $journey = Journey::find($id);
        $journey->delete();

        return response()->json('Removed successfully.');
    }


}

?>
