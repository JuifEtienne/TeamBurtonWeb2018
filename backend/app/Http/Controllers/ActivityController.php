<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{

    public function getAll() {

        $activities = Activity::all();

        return response()->json($activities);

    }

    public function getActivity($id) {

        $activity = Activity::find($id); // find permet de récupérer un objet par sa clé primaire

        return response()->json($activity);
    }

    public function createActivity(Request $request) {

        $activity = Activity::create($request->all());

        return response()->json($activity);

    }

    public function updateActivity(Request $request, $id) {

        $activity = Activity::find($id);
        $activity->name = $request->input('name');
        $activity->date = $request->input('date');
        $activity->price = $request->input('price');
        $activity->save();

        return response()->json($activity);
    }

    public function deleteActivity($id) {

        $activity = Activity::find($id);
        $activity->delete();

        return response()->json('Removed successfully.');
    }

    public function getAllFromDestination($idDestination) {

        $activities = DB::table('activity')
            ->select('activity.id', 'name', 'price', 'date')
            ->join('include', 'activity.id', '=', 'include.idActivity')
            ->where('idDestination', '=', $idDestination)
            ->orderBy('date')
            ->get();

        return response()->json($activities);

    } 

    public function addActivityToDestination($idDestination, $idActivity) {

        DB::table('include')->insert([
            'idActivity' => $idActivity,
            'idDestination' => $idDestination
        ]);

        return response()->json('Added successfully');

    }

    public function deleteActivityFromDestination($idDestination, $idActivity) {

        DB::table('include')
            ->where('idDestination', '=', $idDestination)
            ->where('idActivity', '=', $idActivity)
            ->delete();

        return response()->json('Removed successfully');

    }

    public function getPriceSumFromDestination($idDestination) {

        $activities = DB::table('activity')
            ->select(DB::raw('sum(price) AS sum'))
            ->join('include', 'activity.id', '=', 'include.idActivity')
            ->where('idDestination', '=', $idDestination)
            ->get();

        return response()->json($activities);

    } 

}

?>