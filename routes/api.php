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


Route::get('nivel_formacions', 'Nivel_formacionController@darNivel_formacions');
Route::post('guardarNivel_formacion', 'Nivel_formacionController@guardarNivel_formacion');

Route::get('programas', 'ProgramaController@darProgramas');
Route::post('guardarPrograma', 'ProgramaController@guardarPrograma');

Route::get('visitantes', 'VisitanteController@darVisitantes');
Route::post('guardarVisitante', 'VisitanteController@guardarVisitante');