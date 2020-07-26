<?php

/*
    ROTAS API APAMS
*/

use Illuminate\Http\Request;

# ROTA PARA REGISTRO DE USUÁRIO
Route::post('/register', 'API\UserController@register'); 

# ROTA PARA LOGIN DE USUÁRIO
Route::post('/login','API\UserController@login');

# ROTAS COM MIDDLEWARE AUTH, OU SEJA, ACESSIVEIS SOMENTE COM AUTENTICAÇÃO
Route::group(['middleware' => 'auth:api'], function(){
    
    //ROTAS PARA USUÁRIO
    Route::prefix('/user')->group(function(){
        Route::get('/profile','API\UserController@showProfile');
        Route::post('/update', 'API\UserController@updateUser');
        Route::get('/logout', 'API\UserController@logout');
    });

    //ROTAS PARA ANIMAIS
    Route::prefix('/animals')->group(function(){
        Route::get('/show','API\AnimalsController@show');
        Route::get('{id}/show','API\AnimalsController@showAnimal');
        Route::get('{id}/gallery','API\AnimalsController@gallery');
        Route::get('/{id}/adopt','API\AnimalsController@adopt');
    });

    //ROTAS PARA POSTAGENS
    Route::prefix('/posts')->group(function(){
        Route::get('/show','API\PostController@show');
        Route::get('/{id}/show','API\PostController@showPost');
        Route::get('/{id}/like','API\PostController@likePost');
        Route::get('/{id}/unlike','API\PostController@unlikePost');
        Route::get('/{id}/comments','API\CommentsController@show');
        Route::post('/{id}/comments/message','API\CommentsController@message');
    });

    Route::prefix('/about')->group(function(){
        Route::get('/','API\AboutController@about');
        Route::get('/sponsors','API\AboutController@sponsors');
    });

});
