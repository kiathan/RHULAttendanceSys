<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',
    function () {
        return view('welcome');
    });

Route::get('/login', 'singinColtroller@singin');


Route::post('/login', 'singinColtroller@login');

Route::get('/auth/index', 'AuthController@index');
Route::get('/auth/create', 'AuthController@create');
Route::post('/auth/store', 'AuthController@store');


Route::post('/api/auth/login', 'apiController@postLogin');
Route::get('/api/auth/login', 'apiController@getLogin');

