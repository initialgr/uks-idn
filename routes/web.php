<?php

use App\Http\Controllers\DrugController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RetrievalController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::match(["GET", "POST"], "/register", function () {
    return redirect("/login");
})->name("register");

Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', UserController::class);
    Route::resource('record', RecordController::class);
    Route::resource('drug', DrugController::class);
    Route::resource('retrieval', RetrievalController::class);
    Route::resource('room', RoomController::class);

    Route::get('print/record', [RecordController::class, 'print'])->name('record.print');
    Route::get('print/drug', [DrugController::class, 'print'])->name('drug.print');
    Route::get('print/retrieval', [RetrievalController::class, 'print'])->name('retrieval.print');
    Route::post('stock/drug', [DrugController::class, 'stock'])->name('drug.stock');

});
// Route::view('template', 'layouts.template');
Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');


