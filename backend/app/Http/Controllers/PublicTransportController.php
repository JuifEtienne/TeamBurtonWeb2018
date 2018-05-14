<?php

namespace App\Http\Controllers;

use App\Classes\PublicTransport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicTransportController extends Controller
{
    public function getAll() {

        $publictransports = PublicTransport::all();

        return response()->json($publictransports);

    }

    public function getPublicTransport($id) {

        $publictransport = PublicTransport::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($publictransport);
    }

    public function createPublicTransport(Request $request) {

        $publictransport = PublicTransport::create($request->all());

        return response()->json($publictransport);

    }

    public function updatePublicTransport(Request $request, $id) {

        $publictransport = PublicTransport::find($id);
        $publictransport->name = $request->input('name');
        $publictransport->save();

        return response()->json($publictransport);
    }

    public function deletePublicTransport($id) {

        $publictransport = PublicTransport::find($id);
        $publictransport->delete();

        return response()->json('Removed successfully.');
    }


}

?>