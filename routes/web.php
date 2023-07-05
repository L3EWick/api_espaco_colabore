<?php

use Illuminate\Support\Facades\Route;

Route::get('/',            "AuthController@login")->name('login');
Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'acesso']], function () {

    Route::get ('/', 		'HomeController@index')->name('home');
    Route::resource('user',			'UserController');
    
    Route::get('user/liberar/{id}', 'UserController@liberar')->name('liberar');
    Route::get('user/proibir/{id}', 'UserController@proibir')->name('proibir');


  
});