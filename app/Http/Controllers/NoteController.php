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


        //validation doğrulama

       $request->validate(
            [
                // 'doğrulamakİstediğimKey' => 'Kurallarım'
                // 'title' => 'Zorunlu, Minimum 3 karakter'

                'title' => 'required | min:13 | max:20',
                'content' => 'required '

            ],[
                //custom message
                // keyAdı.kuralAdı => 'Mesaj',
                'title.required' => 'Başlık yazmayı unutma',
                'title.min' => 'Lütfen daha uzun yaz'
           ]
        ); // true false


        //laravel otomatik olarak errors gönderir
        //eğer validate kısmında hata varsa
        //          return redirect()->back()->with('errors','message');


        // validasyondan geçtiyse
        $note = new Note();
        $note->user_id = Auth::user()->id;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        //return redirect()->back();

        //başarılı durum
        return redirect()->route('notes_index')->with('success','Başarıyla Kaydedildi');



    }
}
