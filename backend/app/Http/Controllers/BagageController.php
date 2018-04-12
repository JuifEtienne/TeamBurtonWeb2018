<?php

namespace App\Http\Controllers;

use App\Classes\Bagage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BagageController extends Controller
{
    public function getAll() {

        $bagages = Bagage::all();

        return response()->json($bagages);

    }

    public function getBagage($id) {

        $bagage = Bagage::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($bagage);
    }

    public function createBagage(Request $request) {

        $bagage = Bagage::create($request->all());

        return response()->json($bagage);

    }

    public function updateBagage(Request $request, $id) {

        $bagage = Bagage::find($id);
        $bagage->nom = $request->input('nom');
        $bagage->save();

        return response()->json($bagage);
    }

    public function deleteBagage($id) {

        $bagage = Bagage::find($id);
        $bagage->delete();

        return response()->json('Removed successfully.');
    }


}

?>
