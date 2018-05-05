<?php

namespace App\Http\Controllers;

use App\Classes\Contain;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContainController extends Controller
{
    public function getAllObjectsFromLuggage($idLuggage) {

        $objects = Contain::where('idLuggage', '=', $idLuggage)->get();

        return response()->json($objects);

    }

}

?>
