<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Auth\LoginController@index')->name('index');
Route::post('/login','Auth\LoginController@login');
Route::get('/sair', function(){ Auth::logout(); return redirect(''); });

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home','homeController@show');
    Route::get('/configuracoes','ConfiguracoesController@show')->middleware('check.user');

    Route::prefix('/users')->group(function(){
        Route::get('/', 'UserController@show');
        Route::match(['get', 'post'], '/register', 'Auth\RegisterController@register');
        Route::match(['get', 'post'],'/update', 'UserController@update');
        Route::get('/delete', 'UserController@delete');
    });

    Route::prefix('/animais')->group(function(){
        Route::get('/','AnimalsController@showWeb');
        Route::match(['get', 'post'], '/cadastro', 'AnimalsController@registerWeb')->middleware('check.google');
        Route::match(['get', 'post'],'/update', 'AnimalsController@updateWeb')->middleware('check.google');
        Route::post('/delete', 'AnimalsController@registerWeb');
    });

    Route::prefix('/patrocinadores')->group(function(){
        Route::post('/cadastrar', 'SponsorsController@register')->middleware('check.google');
        Route::post('/atualizar', 'SponsorsController@update')->middleware('check.google');
    });

    Route::prefix('/postagens')->group(function(){
        Route::get('/','PostController@show')->middleware('check.user');
        Route::match(['get', 'post'], '/create', 'PostController@create');
        Route::post('/update','PostController@update');
        Route::post('/delete','PostController@delete');
    });

    Route::prefix('/notificacoes')->group(function(){
        Route::get('/','NotificationController@show')->middleware('check.user');
        Route::post('/create','NotificationController@create');
    });
});








Route::get('callback', 'Auth\LoginController@callback');
Route::prefix('/auth')->group(function () {
    Route::get('google', 'Auth\LoginController@redirect');
    Route::name('logout')->post('logout', 'LoginController@logout');
});




Route::middleware('auth')->group(function () {
    Route::resource('albums', 'AlbumController');

    Route::resource('mediaitems', 'MediaController');

    Route::name('mediaitems.album')->get('mediaitems/album/{id}', 'MediaController@album');

    Route::view('upload', 'form')->name('form');
    Route::name('upload')->post('upload', 'UploadController');
});
