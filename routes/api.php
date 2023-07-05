<?php

use Illuminate\Http\Request;

Route::post('login', 'Api\ApiUserController@login');
Route::post('form', 'Api\ApiFormController@store');
Route::post('register', 'Api\ApiUserController@index');



Route::post('reset', 'Api\ApiUserController@reset');









