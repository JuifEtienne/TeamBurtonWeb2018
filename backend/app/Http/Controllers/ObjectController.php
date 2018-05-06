<?php

namespace App\Http\Controllers;

use App\Classes\Objet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectController extends Controller
{
    public function getAll() {

        $objects = Objet::orderBy('idCategory')->orderBy('name')->get();

        return response()->json($objects);

    }

    public function getAllFromLuggage($idLuggage) {

        $objects = DB::table('object')
            ->select('name', 'present', 'quantity', 'idObject', 'idLuggage', 'idCategory')
            ->join('contain', 'object.id', '=', 'contain.idObject')
            ->where('idLuggage', '=', $idLuggage)
            ->orderBy('idCategory')
            ->orderBy('name')
            ->get();

        return response()->json($objects);

    }

    public function createObject(Request $request) {

        $object = Objet::create($request->all());

        return response()->json($object);

    }

    public function updateObject(Request $request, $id) {

        $object = Objet::find($id);
        $object->name = $request->input('name');
        $object->idCategory = $request->input('idCategory');
        $object->save();

        return response()->json($object);
    }

}

?>
