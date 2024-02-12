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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/home', action: 'App\Http\Controllers\HomeController@home')->name('home.index');;

Route::get('/about', action: 'App\Http\Controllers\AboutController@index')->name('about.index');

Route::get('/room', action: 'App\Http\Controllers\RoomController@index')->name('room.index');;
Route::post('/room', action:'App\Http\Controllers\RoomController@store')->name('room.store');
Route::get('/room/create', action: 'App\Http\Controllers\RoomController@create')->name('room.create');
Route::get('/room/update', action: 'App\Http\Controllers\RoomController@update');
Route::get('/room/delete', action: 'App\Http\Controllers\RoomController@delete');
Route::get('/room/firstorcreate', action: 'App\Http\Controllers\RoomController@firstOrCreate');
Route::get('/room/updateorcreate', action: 'App\Http\Controllers\RoomController@updateOrCreate');

Route::get('/room/{room}', action: 'App\Http\Controllers\RoomController@show')->name('room.show');
Route::get('/room/{room}/edit', action: 'App\Http\Controllers\RoomController@edit')->name('room.edit');
Route::patch('/room/{room}', action: 'App\Http\Controllers\RoomController@update')->name('room.update');

Route::delete('/room/{room}', action: 'App\Http\Controllers\RoomController@destroy')->name('room.destroy');


