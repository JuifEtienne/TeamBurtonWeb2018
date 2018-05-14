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

        $paper = Paper::create($request->all());

        return response()->json('Added successfully.');

    }

    public function updatePaper(Request $request, $idPaper) {

        $paper = Paper::find($idPaper);
        $paper->name = $request->input('name');
        $paper->save();

        return response()->json('Updated successfully.');

    }

    public function getAllFromDestination($idDestination) {

        $papers = DB::table('paper')
            ->select('paper.idPaper', 'name', 'owner', 'valid', 'description')
            ->join('need', 'paper.idPaper', '=', 'need.idPaper')
            ->where('idDestination', '=', $idDestination)
            ->orderBy('name')
            ->orderBy('owner')
            ->get();

        return response()->json($papers);

    }

    public function addPaperToDestination(Request $request, $idDestination) {

        DB::table('need')->insert([
            'idPaper' => $request->input('idPaper'),
            'idDestination' => $idDestination,
            'owner' => $request->input('owner'),
            'description' => $request->input('description'),
            'valid' => $request->input('valid')
        ]);

        return response()->json('Added successfully.');

    }

    public function updatePaperFromDestination(Request $request, $idDestination, $idPaper) {

        DB::table('need')
            ->where('idDestination', '=', $idDestination)
            ->where('idPaper', '=', $idPaper)
            ->where('owner', '=', $request->input('owner'))
            ->update([
                'valid' => $request->input('valid'),
                'owner' => $request->input('newOwner'),
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



}
