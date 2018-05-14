<?php

namespace App\Http\Controllers;

use App\Classes\Transport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function getAll() {

        $transports = Transport::all();

        return response()->json($transports);

    }

    public function getTransport($id) {

        $transport = Transport::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($transport);
    }

    public function createTransport(Request $request) {

        $transport = Transport::create($request->all());

        return response()->json($transport);

    }

    public function updateTransport(Request $request, $id) {

        $transport = Transport::find($id);
        $transport->name = $request->input('name');
        $transport->save();

        return response()->json($transport);
    }

    public function deleteTransport($id) {

        $transport = Transport::find($id);
        $transport->delete();

        return response()->json('Removed successfully.');
    }


}

?>