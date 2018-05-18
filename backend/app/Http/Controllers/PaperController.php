<?php

namespace App\Http\Controllers;

use App\Classes\Paper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaperController extends Controller
{
    public function getAll() {

        $papers = Paper::orderBy('name')->get();

        return response()->json($papers);

    }

    public function getPaper($idPaper) {

        $paper = Paper::find($idPaper);

        return response()->json($paper);

    }

    public function createPaper(Request $request) {

        if (DB::table('paper')->where('name', $request->input('name'))->exists() == false) {
            $paper = DB::table('paper')->insert([
                'name' => ucfirst(strtolower($request->input('name')))
            ]);
        } else {
            return response()->json('Paper already exists.');
        }

        return response()->json('Added successfully.');

    }

    public function updatePaper(Request $request, $idPaper) {

        $paper = Paper::find($idPaper);
        $paper->name = ucfirst(strtolower($request->input('name')));
        $paper->save();

        return response()->json('Updated successfully.');

    }

    public function getAllFromDestination($idDestination) {

        $papers = DB::table('paper')
            ->select('paper.id', 'name', 'owner', 'valid', 'description')
            ->join('need', 'paper.id', '=', 'need.idPaper')
            ->where('idDestination', '=', $idDestination)
            ->orderBy('name')
            ->orderBy('owner')
            ->get();

        return response()->json($papers);

    }

    public function addPaperToDestination(Request $request, $idDestination, $idPaper) {

        DB::table('need')->insert([
            'idPaper' => $idPaper,
            'idDestination' => $idDestination,
            'owner' => ucfirst(strtolower($request->input('owner'))),
            'description' => $request->input('description'),
            'valid' => $request->input('valid')
        ]);

        return response()->json('Added successfully.');

    }

    public function updatePaperFromDestination(Request $request, $idDestination, $idPaper) {

        DB::table('need')
            ->where('idDestination', '=', $idDestination)
            ->where('idPaper', '=', $idPaper)
            ->where('owner', '=', ucfirst(strtolower($request->input('owner'))))
            ->update([
                'valid' => $request->input('valid'),
                'owner' => ucfirst(strtolower($request->input('newOwner'))),
                'description' => $request->input('description')
            ]);

        return response()->json('Updated successfully.');

    }

    public function deletePaperFromDestination(Request $request, $idDestination, $idPaper) {

        DB::table('need')
            ->where('idDestination', '=', $idDestination)
            ->where('idPaper', '=', $idPaper)
            ->where('owner', '=', $request->input('owner'))
            ->delete();

        return response()->json('Removed successfully.');

    }

    public function createPaperAndAddToDestination(Request $request, $idDestination) {

        $request->all()["name"] = ucfirst(strtolower($request->all()["name"]));
        
        if (DB::table('paper')->where('name', $request->input('name'))->exists() == false) {
            $paper = DB::table('paper')->insert([
                'name' => ucfirst(strtolower($request->input('name')))
            ]);
        }

        $idPaper = DB::table('paper')->select('id')->where('name', $request->input('name'))->first();

        DB::table('need')->insert([
            'idPaper' => $idPaper->id,
            'idDestination' => $idDestination,
            'valid' => $request->input('valid'),
            'owner' => ucfirst(strtolower($request->input('owner'))),
            'description' => $request->input('description')
        ]);

        return response()->json('Added successfully. ');

    }



}
