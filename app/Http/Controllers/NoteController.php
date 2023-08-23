<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index(){

        return view('front.notes.index');
    }


    public function createPage(){

        return view('front.notes.create');

    }

    //store add



    public function addNote(Request $request){
        // request
        // dd die and dump dd('elif')
        // dd( $request->all() );
        // dd( $request["not_baslik"] );
        // dd( $request->not_baslik );
        // Auth::user();
        //dd( Auth::user()->id );
        //dd( Auth::id() );


        // validasyon
        $note = new Note();
        $note->user_id = Auth::user()->id;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();


    }
}
