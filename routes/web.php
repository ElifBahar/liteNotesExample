<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    //auth
    //permission
    return view('welcome');
});



//jetstream

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    //kişilerin login olmadan görmesini istemediimiz yapılar
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /*
    Route::get('/elifBahar',function (){
        return 5;
    });
    */


    // YAJRA DATATABLE

// Note Routeları

    Route::get('/notes',[NoteController::class, 'index'])->name('notes_index');
    Route::get('/notesYajra',[NoteController::class, 'indexYajra'])->name('notes_indexYajra');
    Route::get('/fetchNotes', [NoteController::class, 'fetchNotes'])->name('fetchNotes');
    Route::get('/notes/createPage',[NoteController::class, 'createPage'])->name('notes_createPage'); //create
    Route::post('/notes/addNote',[NoteController::class, 'addNote'])->name('notes_addNote'); //store

    //PARAMETRELİ DETAY
    Route::get('/notes/detail/{bahar}',[NoteController::class, 'detail1'])->name('notes_detail1');
    //PARAMETERSİZ
    //!!!!!Route::get('/notes/detail/',[NoteController::class, 'detailNoParam'])->name('notes_detailNoParam');



    Route::get('/notes/update/{note_id}',[NoteController::class, 'update'])->name('notes_update');
    //Form güncelleme post
    Route::post('/notes/update/edit/{note_id}', [NoteController::class, 'edit'])->name('notes_editNote');

    //parametresiz post
    Route::post('/notes/update/edit',[NoteController::class, 'editNoParameter'])->name('notes_editNoteNoParameter');

});

//// TEST ROUTELARI BAŞLANGIÇ
///
///
Route::get('/masterTest',function (){
   return view('front.layouts.master');
});
///
///
//// TEST ROUTELARI BİTİŞ
