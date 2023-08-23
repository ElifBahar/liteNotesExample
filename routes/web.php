<?php

use App\Http\Controllers\NoteController;
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
    return view('welcome');
});





// Note Routeları

Route::get('/notes',[NoteController::class, 'index'])->name('notes_index');




//jetstream

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //kişilerin login olmadan görmesini istemediimiz yapılar
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


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
