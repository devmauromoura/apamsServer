<?php

/* 
    ROTAS WEB APAMS

    Obs.: 
    middleware('check.user') = Validação de o usuário está ativo.
    middleware('check.google') =  Validação se o usuário possui uma conta Google.

*/


# ROTA PARA TELA DE LOGIN
Route::get('/','Auth\LoginController@index')->name('index');

Route::get('callback', 'Auth\LoginController@callback');
Route::prefix('/auth')->group(function () {
    Route::get('google', 'Auth\LoginController@redirect');
    Route::name('logout')->post('logout', 'Auth\LoginController@logout');
});

#ROTA PARA VALIDAR LOGIN E SAIR
Route::post('/login','Auth\LoginController@login');
Route::get('/sair','Auth\LoginController@sair');


# ROTAS COM MIDDLEWARE AUTH, OU SEJA, ACESSIVEIS SOMENTE COM AUTENTICAÇÃO
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home','homeController@show');
    Route::get('/configuracoes','ConfiguracoesController@show')->middleware('check.user');

    // ROTAS DE USUÁRIO
    Route::prefix('/users')->group(function(){
        Route::get('/', 'StaffController@show');
        Route::match(['get', 'post'], '/register', 'Auth\RegisterController@register');
        Route::match(['get', 'post'],'/update', 'StaffController@update');
        Route::get('/delete', 'StaffController@delete');
    });

    // ROTAS DE ANIMAIS
    Route::prefix('/animais')->group(function(){
        Route::get('/','AnimalsController@showWeb');
        Route::match(['get', 'post'], '/cadastro', 'AnimalsController@registerWeb');
        Route::match(['get', 'post'],'/update', 'AnimalsController@updateWeb');
        Route::post('/delete', 'AnimalsController@registerWeb');
    });

    // ROTAS DE PATROCINADORES
    Route::prefix('/patrocinadores')->group(function(){
        Route::post('/cadastrar', 'SponsorsController@register');
        Route::post('/atualizar', 'SponsorsController@update');
    });

    // ROTAS DE POSTAGENS
    Route::prefix('/postagens')->group(function(){
        Route::get('/','PostController@show')->middleware('check.user');
        Route::match(['get', 'post'], '/create', 'PostController@create');
        Route::post('/update','PostController@update');
        Route::post('/delete','PostController@delete');
    });

    // ROTAS DE NOTIFICAÇÕES
    Route::prefix('/notificacoes')->group(function(){
        Route::get('/','NotificationController@show')->middleware('check.user');
        Route::post('/create','NotificationController@create');
    });
});



// IGNORAR
Route::middleware('auth')->group(function () {
    Route::resource('albums', 'AlbumController');
    Route::resource('mediaitems', 'MediaController');
    Route::name('mediaitems.album')->get('mediaitems/album/{id}', 'MediaController@album');
    Route::view('upload', 'form')->name('form');
    Route::name('upload')->post('upload', 'UploadController');
});


// ROTAS PARA TESTES DE DESENVOLVIMENTO
Route::get('/google/getaccesstoken','TestesController@getat');