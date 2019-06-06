<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/','Auth\LoginController@index')->name('index');
Route::post('/login','Auth\LoginController@login');
Route::get('/logout', function(){ Auth::logout(); return "deslogado"; });

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home','homeController@show');

    Route::prefix('/users')->group(function(){
        Route::get('/', 'UserController@show');
        Route::match(['get', 'post'], '/register', 'Auth\RegisterController@register');
        Route::match(['get', 'post'],'/update', 'UserController@update');
        Route::get('/delete', 'UserController@delete');
    });

    Route::prefix('/animals')->group(function(){
        Route::get('/','AnimalsController@showWeb');
        Route::match(['get', 'post'], '/register', 'AnimalsController@registerWeb');
        Route::match(['get', 'post'],'/update', 'AnimalsController@updateWeb');
        Route::post('/delete', 'AnimalsController@registerWeb');
    });

    Route::prefix('/posts')->group(function(){
        Route::get('/','PostController@show');
        Route::match(['get', 'post'], '/create', 'PostController@create');
        Route::post('/update','PostController@update');
        Route::post('/delete','PostController@delete');
    });
});
