<?php

namespace App\Http\Controllers;
 
use App\Classes\Word;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function getAll() {

        $words = Word::orderBy('word', 'asc')->pluck('word');

        // Appel API translation (Yandex ?)

        return response()->json($words);
        
    }

    public function createWord(Request $request) {
 
        $word = Word::create($request->all());
 
        return response()->json('Added successfully');
 
    }
 
    public function updateWord(Request $request, $id) {
 
        $word = Word::find($id); 
        $word->word = $request->input('word');
        $word->save();
 
        return response()->json('Updated successfully');

    }  
 
    public function deleteWord($id) {

        $word = Word::find($id);
        $word->delete();
 
        return response()->json('Removed successfully');

    }
   
}
