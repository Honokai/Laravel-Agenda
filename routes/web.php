<?php

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


Auth::routes(['verify' => true]);

Route::get('profile', function () {
    Route::get('/agenda', function(){
        if(Auth::id() != NULL){
            return view('agenda');
        }else{
            return view('welcome');
        }
    });
})->middleware('verified');

Route::get('/agenda', function(){
    if(Auth::id() != NULL){
        return view('agenda');
    }else{
        return view('welcome');
    }
});
Route::get('/', function(){return view('welcome');});

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');
