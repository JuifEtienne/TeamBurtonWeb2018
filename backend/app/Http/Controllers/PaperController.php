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

        $paper = Paper::find($id);

        return response()->json($paper);

    }

    public function createPaper(Request $request) {
 
        $paper = Paper::create($request->all());

        return response()->json('Added successfully');

    }
 
    public function updatePaper(Request $request, $idPaper) {
 
        $paper = Paper::find($id); 
        $paper->name = $request->input('name');
        $paper->note = $request->input('note');
        $paper->save();
 
        return response()->json('Updated successfully');
        
    }

    public function getAllFromDestination($idDestination) {

        $papers = DB::table('paper')
            ->select('idPaper', 'name', 'valid', 'note')
            ->join('need', 'paper.id', '=', 'need.idPaper')
            ->where('idDestination', '=', $idDestination)
            ->orderBy('name')
            ->get();

        return response()->json($papers);

    } 

    public function addPaperToDestination(Request $request, $idDestination) {

        DB::table('need')->insert([
            'valid' => $request->input('valid'),
            'idPaper' => $request->input('idPaper'),
            'idDestination' => $idDestination
        ]);

        return response()->json('Added successfully');

    }

    public function updatePaperFromDestination(Request $request, $idDestination, $idPaper) {

        DB::table('need')
            ->where('idDestination', '=', $idDestination)
            ->where('idPaper', '=', $idPaper)            
            ->update([
                'valid' => $request->input('valid')
            ]);

        return response()->json('Updated successfully');

    }

    public function deletePaperFromDestination($idDestination, $idPaper) {

        DB::table('need')
            ->where('idDestination', '=', $idDestination)
            ->where('idPaper', '=', $idPaper)
            ->delete();

        return response()->json('Removed successfully');

    }


   
}
