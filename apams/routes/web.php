<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/','Auth\LoginController@index')->name('index');
Route::post('/login','Auth\LoginController@login');
Route::get('/sair', function(){ Auth::logout(); return redirect(''); });

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home','homeController@show');
    Route::get('/configuracoes','ConfiguracoesController@show');

    Route::prefix('/users')->group(function(){
        Route::get('/', 'UserController@show');
        Route::match(['get', 'post'], '/register', 'Auth\RegisterController@register');
        Route::match(['get', 'post'],'/update', 'UserController@update');
        Route::get('/delete', 'UserController@delete');
    });

    Route::prefix('/animais')->group(function(){
        Route::get('/','AnimalsController@showWeb');
        Route::match(['get', 'post'], '/cadastro', 'AnimalsController@registerWeb');
        Route::match(['get', 'post'],'/update', 'AnimalsController@updateWeb');
        Route::post('/delete', 'AnimalsController@registerWeb');
    });

    Route::prefix('/patrocinadores')->group(function(){
        Route::get('/', 'SponsorsController@show');
        Route::post('/cadastrar', 'SponsorsController@register');
    });

    Route::prefix('/posts')->group(function(){
        Route::get('/','PostController@show');
        Route::match(['get', 'post'], '/create', 'PostController@create');
        Route::post('/update','PostController@update');
        Route::post('/delete','PostController@delete');
    });
});

/*  ROTAS PARA TESTES GERAIS */

Route::prefix('/testes')->group(function(){
  Route::get('/upload', function(){
      return view('Testes.upload');
  });
  Route::post('/upload/enviar', 'GalleryController@enviar');
});