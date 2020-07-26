<?php

/* 
    ROTAS WEB APAMS

    Obs.: 
    middleware('check.user') = Validação de o usuário está ativo.
    middleware('check.google') =  Validação se o usuário possui uma conta Google.

*/

# ROTA PARA TELA DE LOGIN
    Route::get('/','Auth\LoginController@index')->name('index');
# ROTA PARA TELA DE LOGIN

# ROTAS PARA VALIDAR LOGIN E SAIR
    Route::post('/login','Auth\LoginController@login');
    Route::get('/sair','Auth\LoginController@sair');
# ROTAS PARA VALIDAR LOGIN E SAIR

# ROTAS AUTENTICADAS
    Route::group(['middleware' => 'auth'], function(){

    // ROTA DE HOMEPAGE
        Route::get('/home','homeController@show');
    // ROTA DE HOMEPAGE

    // ROTAS DE POSTAGENS
        Route::prefix('/postagens')->group(function(){
            Route::get('/','PostController@index');
            Route::get('/form/{id?}','PostController@formulario')->where(['id' => '[0-9]+']);
            Route::post('/salvar', 'PostController@salvar');
            Route::post('/editar/{id}','PostController@editar')->where(['id' => '[0-9]+']);
            Route::get('/remover/{id}','PostController@remover')->where(['id' => '[0-9]+']);
            Route::get('/dados','PostController@getDados');
            Route::get('/info/{id}','PostController@infoPost')->where(['id' => '[0-9]+']);
        });
    // ROTAS DE POSTAGENS

    // ROTAS DE ANIMAIS
        Route::prefix('/animais')->group(function(){
            Route::get('/','AnimalsController@index');
            Route::get('/form/{id?}','AnimalsController@formulario')->where(['id' => '[0-9]+']);
            Route::post('/salvar', 'AnimalsController@salvar');
            Route::post('/editar/{id}', 'AnimalsController@editar')->where(['id' => '[0-9]+']);
            Route::get('/remover/{id}', 'AnimalsController@remover')->where(['id' => '[0-9]+']);
            Route::get('/dados','AnimalsController@getDados');
        });
    // ROTAS DE ANIMAIS

    // ROTAS DE PATROCINADORES
        Route::prefix('/patrocinadores')->group(function(){
            Route::get('/','PatrocionadorController@index');
            Route::get('/form/{id?}','PatrocionadorController@formulario')->where(['id' => '[0-9]+']);
            Route::post('/salvar', 'PatrocionadorController@salvar');
            Route::post('/editar/{id}', 'PatrocionadorController@editar')->where(['id' => '[0-9]+']);
            Route::get('/remover/{id}', 'PatrocionadorController@remover')->where(['id' => '[0-9]+']);
            Route::get('/dados','PatrocionadorController@getDados');
        });
    // ROTAS DE PATROCINADORES

    // ROTAS DE USUÁRIO
        Route::prefix('/usuarios')->group(function(){
            Route::get('/','UserController@index');
            Route::get('/form/{id?}','UserController@formulario')->where(['id' => '[0-9]+']);
            Route::post('/salvar', 'UserController@salvar');
            Route::post('/editar/{id}', 'UserController@editar')->where(['id' => '[0-9]+']);
            Route::get('/remover/{id}', 'UserController@remover')->where(['id' => '[0-9]+']);
            Route::get('/dados','UserController@getDados');
        });
    // ROTAS DE USUÁRIO

    // ROTAS DE CONFIGURACOES
        Route::prefix('/configuracoes')->group(function(){
            Route::get('/','ConfiguracoesController@index');
            Route::get('/form/{id?}','ConfiguracoesController@formulario')->where(['id' => '[0-9]+']);
            Route::post('/salvar', 'ConfiguracoesController@salvar');
            Route::post('/editar/{id}', 'ConfiguracoesController@editar')->where(['id' => '[0-9]+']);
            Route::get('/remover/{id}', 'ConfiguracoesController@remover')->where(['id' => '[0-9]+']);
            Route::get('/dados','ConfiguracoesController@getDados');
        });
    // ROTAS DE CONFIGURACOES

    });
# ROTAS AUTENTICADAS