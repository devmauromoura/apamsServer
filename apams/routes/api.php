<?php

use Illuminate\Http\Request;

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

Route::post('/register', 'Auth\RegisterController@create'); //Cadastrar Usuário
Route::post('/register/password/{id}', 'Auth\RegisterController@savepass'); // Aplicar senha usuário

Route::post('/login','Auth\LoginController@loginapi');

Route::group(['middleware' => 'auth:api'], function(){

});
