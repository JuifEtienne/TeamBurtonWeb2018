<?php

namespace App\Http\Controllers;
 
use App\Classes\Paper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    public function getAll() {

        $papers = Paper::orderBy('name')->get();

        return response()->json($papers);
    }

    public function getPaper($id) {

        $paper = Paper::find($id);

        return response()->json($paper);
    }

    public function createPaper(Request $request) {
 
        $paper = Paper::create($request->all());
 
        return response()->json($paper); 
    }
 
    public function updatePaper(Request $request, $id) {
 
        $paper = Paper::find($id); 
        $paper->name = $request->input('name');
        $paper->note = $request->input('note');
        $paper->save();
 
        return response()->json($paper);
    } 
   
}
