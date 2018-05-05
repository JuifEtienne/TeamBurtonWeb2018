<?php

namespace App\Http\Controllers;

use App\Classes\Object;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectController extends Controller
{
    public function getAll() {

        $objects = Object::all();

        return response()->json($objects);

    }

    public function getAllFromLuggage($idLuggage) {

        $objects = DB::table('object')
            ->select('present', 'name', 'quantity', 'idObject', 'idLuggage')
            ->join('contain', 'object.id', '=', 'contain.idObject')
            ->get();

        return response()->json($objects);

    }

    public function createObject(Request $request) {

        $object = Object::create($request->all());

        return response()->json($object);

    }

    public function updateObject(Request $request, $id) {

        $object = Object::find($id);
        $object->name = $request->input('name');
        $object->idCategory = $request->input('idCategory');
        $object->save();

        return response()->json($object);
    }

}

?>
