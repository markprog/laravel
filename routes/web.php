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
Route::get('/room/create', action: 'App\Http\Controllers\RoomController@create');
Route::get('/room/update', action: 'App\Http\Controllers\RoomController@update');
Route::get('/room/delete', action: 'App\Http\Controllers\RoomController@delete');
Route::get('/room/firstorcreate', action: 'App\Http\Controllers\RoomController@firstOrCreate');
Route::get('/room/updateorcreate', action: 'App\Http\Controllers\RoomController@updateOrCreate');


