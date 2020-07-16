<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/planilha/{file}', 'PlanilhaController@download');

Route::post('/registro','AdminController@registro')->name('registro');

Route::get('/agenda', 'AdminController@agenda')->name('agenda')->middleware('verified');

Route::get('/painel', 'AdminController@painel')->name('painel')->middleware('verified');

Route::get('/', function(){
    if(!Auth::check()){
        return view('auth/login');
    }else{
        return view('agenda');
    }
});

Route::get('/home', 'HomeController@index')->name('home');
