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

Route::post('/register', 'Auth\RegisterController@registerApi'); //Cadastrar Usuário

Route::post('/login','Auth\LoginController@loginapi');

Route::group(['middleware' => 'auth:api'], function(){
    Route::prefix('/user')->group(function(){
        Route::get('/profile','UserController@showProfile');
    });
        Route::post('/update', 'UserController@updateUser');

    Route::prefix('/animals')->group(function(){
        Route::get('/show','AnimalsController@show');
        Route::get('/show/{id}','AnimalsController@showAnimal');
    });

    Route::prefix('/posts')->group(function(){
        Route::get('/show','PostController@showApi');
        Route::post('/like','PostController@likePost');
    });

});