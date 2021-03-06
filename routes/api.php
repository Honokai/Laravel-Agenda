<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('eventos/{id}', 'ApiController@carregarCalendario');
Route::get('eventos/evento/{id}', 'ApiController@carregarEvento');
Route::get('historico/observacao','ApiController@histobs'); 
Route::post('eventos','ApiController@cadastraEvento');

Route::put('eventos/atualizar/', 'ApiController@atualizarEvento');
Route::put('eventos/atualizarDrop/', 'ApiController@arrastaEsoltaEvento');

Route::delete('eventos/{id}','ApiController@deletarEvento');

Route::get('relatorio','ApiController@criarRelatorio');
Route::post('relatorio','ApiController@criarRelatorio');

Route::delete('excluir','ApiController@excluirUsuario');
