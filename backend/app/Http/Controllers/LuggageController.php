<?php

namespace App\Http\Controllers;

use App\Classes\Luggage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LuggageController extends Controller
{
    public function getAll() {

        $luggages = Luggage::orderBy('name')->get();

        return response()->json($luggages);

    }

    public function getLuggage($id) {

        $luggage = Luggage::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($luggage);
    }

    public function createLuggage(Request $request) {

        $luggage = Luggage::create($request->all());

        return response()->json($luggage);

    }

    public function updateLuggage(Request $request, $id) {

        $luggage = Luggage::find($id);
        $luggage->name = $request->input('name');
        $luggage->save();

        return response()->json($luggage);
    }

    public function deleteLuggage($id) {

        $luggage = Luggage::find($id);
        $luggage->delete();

        return response()->json('Removed successfully.');
    }


}

?>
