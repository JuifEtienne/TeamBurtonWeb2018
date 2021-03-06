<?php

namespace App\Http\Controllers;

use App\Classes\Luggage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LuggageController extends Controller
{
    public function getAll() {

        $luggages = Luggage::orderBy('name')->get();

        return response()->json($luggages);

    }

    public function getLuggage($idLuggage) {

        $luggage = Luggage::find($idLuggage); // find permet de récupérer un objet par sa clé primaire

        return response()->json($luggage);

    }

    public function createLuggage(Request $request) {

        $luggage = Luggage::create($request->all());

        return response()->json('Added successfully.');

    }

    public function updateLuggage(Request $request, $idLuggage) {

        $luggage = Luggage::find($id);
        $luggage->name = $request->input('name');
        $luggage->save();

        return response()->json('Updated successfully.');

    }

    public function deleteLuggage($idLuggage) {

        $luggage = Luggage::find($idLuggage);
        $luggage->delete();

        return response()->json('Removed successfully.');

    }

    public function getAllObjectsFromLuggage($idLuggage) {

        $objects = DB::table('object')
            ->select('name', 'present', 'quantity', 'object.id', 'idLuggage', 'idCategory')
            ->join('contain', 'object.id', '=', 'contain.idObject')
            ->where('idLuggage', '=', $idLuggage)
            ->orderBy('idCategory')
            ->orderBy('name')
            ->get();

        return response()->json($objects);

    }

    public function getIdObjectMaxFromLuggage(Request $request, $idLuggage) {

        $idMax = DB::table('contain')
            ->where('idLuggage', '=', $idLuggage)
            ->max('idObject');

        return response()->json(['idMax' => $idMax]);

    }

    public function addObjectToLuggage(Request $request, $idLuggage, $idObject) {

        DB::table('contain')->insert([
            'present' => $request->input('present'),
            'quantity' => $request->input('quantity'),
            'idObject' => $idObject,
            'idLuggage' => $idLuggage
        ]);

        return response()->json('Added successfully.');

    }

    public function updateObjectFromLuggage(Request $request, $idLuggage, $idObject) {

        DB::table('contain')
            ->where('idObject', '=', $idObject)
            ->where('idLuggage', '=', $idLuggage)
            ->update([
                'present' => $request->input('present'),
                'quantity' => $request->input('quantity')
            ]);

        return response()->json('Updated successfully.');

    }

    public function objectIsPresentInLuggage($idLuggage, $idObject) {

        DB::table('contain')
            ->where('idObject', '=', $idObject)
            ->where('idLuggage', '=', $idLuggage)
            ->update([
                'present' => 1
            ]);

        return response()->json('Object is now present.');

    }

    public function deleteObjectFromLuggage($idObject, $idLuggage) {

        DB::table('contain')
            ->where('idObject', '=', $idObject)
            ->where('idLuggage', '=', $idLuggage)
            ->delete();

        return response()->json('Removed successfully.');

    }

    public function createObjectAndAddToLuggage(Request $request, $idLuggage) {

        $request->all()["name"] = ucfirst(strtolower($request->all()["name"]));
        
        if (DB::table('object')->where('name', $request->input('name'))->exists() == false) {
            $object = DB::table('object')->insert([
                'name' => ucfirst(strtolower($request->input('name')))
            ]);
        }

        $idObject = DB::table('object')->select('id')->where('name', $request->input('name'))->first();

        DB::table('contain')->insert([
            'idObject' => $idObject->id,
            'idLuggage' => $idLuggage,
            'present' => $request->input('present'),
            'quantity' => $request->input('quantity')
        ]);

        return response()->json('Added successfully. ');

    }


}

?>
