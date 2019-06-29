<?php

/*
    ROTAS API APAMS
*/

use Illuminate\Http\Request;

# ROTA PARA REGISTRO DE USUÁRIO
Route::post('/register', 'Auth\RegisterController@registerApi'); //Cadastrar Usuário

# ROTA PARA LOGIN DE USUÁRIO
Route::post('/login','Auth\LoginController@loginapi');

# ROTAS COM MIDDLEWARE AUTH, OU SEJA, ACESSIVEIS SOMENTE COM AUTENTICAÇÃO
Route::group(['middleware' => 'auth:api'], function(){
    
    //ROTAS PARA USUÁRIO
    Route::prefix('/user')->group(function(){
        Route::get('/profile','UserController@showProfile');
    });
        Route::post('/update', 'UserController@updateUser');

    //ROTAS PARA ANIMAIS
    Route::prefix('/animals')->group(function(){
        Route::get('/show','AnimalsController@show');
        Route::get('/show/{id}','AnimalsController@showAnimal');
    });

    //ROTAS PARA POSTAGENS
    Route::prefix('/posts')->group(function(){
        Route::get('/show','PostController@showApi');
        Route::get('/show/{id}','PostController@showPost');
        Route::get('/like/{id}','PostController@likePost');
    });

});