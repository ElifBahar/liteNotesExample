<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Mockery\Matcher\Not;
use Yajra\DataTables\DataTables;

class NoteController extends Controller
{
    public function index(){
        //$var = Note::get(); hepsini getirir
        //$var = Note::where('vertabanındakiSütun (haystack)','operatör == != < > <=','aramakİstediğimDeğer(needle)'); hepsini getirir
        //$var = Note::where('title','a')->get();
        //$var = Note::where('id','<','5')->get();

        //$user = User::where('id',2)->first();
        //$notlar = Note::where('user_id',$user->id)->get();

        //dd( $user->getNotes );

        //$not = Note::where('title','ABCDE')->first();
        //dd( $not->getUser );



        //$notlar = Note::where('user_id',Auth::user()->id)->latest('updated_at')->get(); // koleksiyon her zaman var içindekiler muamma
        //latest() default olarak created_at tarihini alır


        //PAGINATION
            $notlar = Note::where('user_id',Auth::user()->id)->latest('updated_at')->paginate(3); // koleksiyon her zaman var içindekiler muamma


        //$notlar = Auth::user()->getNotes;
        //$notlar = Note::where('user_id',Auth::user()->id)->first(); // null kontrolü yapılır



        return view('front.notes.index',compact('notlar'));
    }


    public function indexYajra(){
        return view('front.notes.indexYajra');
    }

    public function fetchNotes()
    {

        $notes = Note::get();
        return DataTables::of($notes)
            ->addColumn('detail', function ($note) {
                return '<a class="btn btn-success" href="' . route('notes_update', $note->id) . '">GÜNCELLE</a>';
            })
            ->addColumn('delete',function ($note){
                //return 'bahar' . $note->id  . 'elif';   //bahar3elif
                return '<button class="btn btn-danger" onclick="ddd('.$note->id.')">Sil</button>';
            })
            ->rawColumns(['detail','delete'])
            ->make();
        //sutunEkle
        //->addColumn()

    }



        /*
         *
         * ->addColumn('delete', function ($data) {
                return "<button onclick='deleteCompany(" . $data->id . ")' class='btn btn-danger'>Sil</button>";
            })
        return DataTables::of($companies)
            ->addColumn('detail', function ($data) {
                return '<a class="btn btn-info" href="' . route('companyDetail', [$data->id]) . '">' . 'Detay</a>';
            })
            ->addColumn('update', function ($data) {
                return "<a href='".route('companyUpdatePage',$data->id)."' class='btn btn-warning'>Güncelle</a>";
            })
            ->addColumn('delete', function ($data) {
                return "<button onclick='deleteCompany(" . $data->id . ")' class='btn btn-danger'>Sil</button>";
            })
            ->addIndexColumn()
            ->rawColumns(['detail', 'update', 'delete'])->make();
        */


    function deleteNoteAjax(Request $request){

        $request->validate([
            'id' => 'required'
        ]);

        //Note::where('id',id)->first();
        $note = Note::find($request->id);
        $note->delete();

        return response()->json(['success' => 'Başarılı']);
/*
        if($note != null){

            $note->delete();

            if($note->delete()){
                return response()->json(['success' => 'Başarılı']);

            }else{
                return response()->json(['error' => 'Hata']);

            }

        }else{
            return response()->json(['error' => 'Hata']);

        }
*/
    }




    function companyDelete(Request $request)
    {
        $request->validate([
            'id' => 'distinct'
        ]);
        Company::find($request->id)->delete();
        return response()->json(['Success' => 'success']);
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
                'content' => 'required | min:12'

            ],[
                //custom message
                // keyAdı.kuralAdı => 'Mesaj',
                'title.required' => 'Başlık yazmayı unutma',
                'title.min' => 'Lütfen başlığı daha uzun yaz',
                'content.min' => 'İçerik 12 karakter olmalıdır'
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
        $note->uuid = Str::uuid();
        $note->save();


        /*

        Note::create([
           'user_id' => Auth::user()->id,
           'title' => $request->title,
            'content' => $request->content,
        ]);

        //bulk
*/
        //return redirect()->back();

        //başarılı durum
        return redirect()->route('notes_index')->with('success','Başarıyla Kaydedildi');

        //return to_route('notes_index');


    }

    public function detail1(Note $not){
        // notlar tablosundaki id si #notID olan veriyi getir

        //query
        //$not = Note::where('uuid',$notUUID)->first();

        //$not = Note::find($notID);

       // if($not->user_id != Auth::user()->id){
         //   abort(403);
       // }




        return view('front.notes.detail1',compact('not'));
    }

    public function detailNoParam(){





    }


    public function update($notID){

        $not = Note::find($notID);

        return view('front.notes.updateNoParam',compact('not'));
    }


    public function edit(Request $request, $notID){

        $request->validate([
            'title' => 'required',
            'content' => 'min:10'
        ]);
        //validasyon

        $not = Note::find($notID);

        $not->title = $request->title;
        $not->content = $request->content;
        $not->save();


        return 'BAŞARILI';

    }



    public function editNoParameter(Request $request){

        $request->validate([
            'title' => 'required',
            'content' => 'min:10',
            'not_id' => 'required'
        ]);


        $not = Note::find($request->not_id);

        $not->title = $request->title;
        $not->content = $request->content;
        $not->save();


        /*
        $not->update([
            'title' => $request->title,
            'content' => $request->content
        ]);
        */


        return redirect()->route('notes_index')->with('message','Güncelleme işlemi başarılı');
    }



}
