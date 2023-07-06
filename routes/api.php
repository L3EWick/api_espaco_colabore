<?php

use Illuminate\Http\Request;

Route::post('login', 'Api\ApiUserController@login');
Route::post('register', 'Api\ApiUserController@index');

Route::get('dados', 'Api\ApiFormController@dados');
Route::post('form', 'Api\ApiFormController@store');


Route::post('reset', 'Api\ApiUserController@reset');









