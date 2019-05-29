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
Route::get('/register','Auth\RegisterController@createView');
Route::post('/register/valid','Auth\RegisterController@createWeb');
Route::get('/logout', function(){
    Auth::logout();
    return "deslogado";
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('/home','homeController@show');

    Route::prefix('/users')->group(function(){

    });
    Route::prefix('/animals')->group(function(){
        
    });
});