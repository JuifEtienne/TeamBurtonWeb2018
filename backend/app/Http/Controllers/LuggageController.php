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

    public function addObjectToLuggage(Request $request, $idLuggage) {

        DB::table('contain')->insert([
        'present' => $request->input('present'),
        'quantity' => $request->input('quantity'),
        'idObject' => $request->input('idObject'),
        'idLuggage' => $idLuggage]);

        return response()->json('Added successfully');

    }

    public function updateObjectFromLuggage(Request $request, $idLuggage) {

        DB::table('contain')->where('idObject', '=', $request->input('idObject'))->where('idLuggage', '=', $idLuggage)->update([
          'present' => $request->input('present'),
          'quantity' => $request->input('quantity')]);

        return response()->json('Updated successfully');

    }

    public function deleteObjectFromLuggage($idObject, $idLuggage) {

        DB::table('contain')->where('idObject', '=', $idObject)->where('idLuggage', '=', $idLuggage)->delete();

        return response()->json('Deleted successfully');

    }


}

?>
