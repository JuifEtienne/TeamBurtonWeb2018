<?php

namespace App\Http\Controllers;
 
use App\Classes\TimeZone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeZoneController extends Controller
{
    public function getAll() {

        $timeZone = TimeZone::all();

        return response()->json($timeZone);
    }

    public function getTimeZone($id) {

        $timeZone = TimeZone::find($id);

        return response()->json($timeZone);
    }

    public function getLocalHour($id) {

        $timeZone = TimeZone::find($id)->name;

        date_default_timezone_set($timeZone);
        $hour = date('H:i');

        return response()->json(['localHour' => $hour]);
    }
   
}
