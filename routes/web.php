<?php

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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/favorite/list', function () {
    return view('list');
})->middleware('auth')->name('favorite.list');
Route::get('/favorite', [App\Http\Controllers\FavoriteController::class, 'AllData'])->name('favorite.data');
Route::post('/favorite', [App\Http\Controllers\FavoriteController::class, 'store'])->name('favorite.data.post');
Route::delete('/favorite/{data}', [App\Http\Controllers\FavoriteController::class, 'delete'])->name('favorite.data.delete');
