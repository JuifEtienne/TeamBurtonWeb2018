<?php

namespace App\Http\Controllers;
 
use App\Classes\Fuseau;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuseauController extends Controller
{
    public function getAll() {

        $fuseaux = Fuseau::all();

        return response()->json($fuseaux);
    }

    public function getFuseau($id) {

        $fuseau = Fuseau::find($id);

        return response()->json($fuseau);
    }

    public function getHeureLocale($id) {

        $fuseau = Fuseau::find($id)->nom;

        date_default_timezone_set($fuseau);
        $heure = date('H:i');

        return response()->json(['heureLocale' => $heure]);
    }
   
}
