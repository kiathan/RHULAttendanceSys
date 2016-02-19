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
        $links = ["/login", "/auth", "/auth/index", "/auth/create", "/couse", "/couse/index", "/couse/create", "/lecture/index", "/lecture/create", "/venue/index", "/venue/create", "/lecture_instends/index", "/lecture_instends/create"];

        $linkText = "";
        foreach ($links as $key => $link) {

            $linkText .= "<a href=\"" . url($link) . "\">" . $link . "</a><br>";
        }
        return $linkText;
    });


Route::group(array("prefix" => "api", "middleware" => "apiSignIn"), function () {

    Route::post('/auth/index', 'AuthController@index');
    Route::post('/auth/create', 'AuthController@create');
    Route::post('/auth/store', 'AuthController@store');
    Route::post('/auth/logout', 'AuthController@logout');


    Route::post('/couse/index', 'courseController@index');
    Route::post('/couse/create', 'courseController@create');
    Route::post('/couse/store/', 'courseController@store');

    Route::post('/lecture/index', 'lectureController@index');
    Route::post('/lecture/create', 'lectureController@create');
    Route::post('/lecture/store', 'lectureController@store');

    Route::post('/venue/index', 'venuController@index');
    Route::post('/venue/create', 'venuController@create');
    Route::post('/venue/store', 'venuController@store');

    Route::post('/lecture_instends/index', 'lectureInstanceController@index');
    Route::post('/lecture_instends/create/{filter?}', 'lectureInstanceController@create');
    Route::post('/lecture_instends/store', 'lectureInstanceController@store');
    Route::post('/lecture_instends/auth', 'lectureInstanceController@auth');

});

Route::post('api/auth/login', 'AuthController@login');

Route::get('/login', 'singinColtroller@singin');


Route::post('/login', 'singinColtroller@login');

Route::get('/auth/index', 'AuthController@index');
Route::get('/auth/create', 'AuthController@create');
Route::post('/auth/store', 'AuthController@store');
Route::get('/auth/logout', 'AuthController@logout');


Route::get('/couse/index', 'courseController@index');
Route::get('/couse/create', 'courseController@create');
Route::post('/couse/store/', 'courseController@store');

Route::get('/lecture/index', 'lectureController@index');
Route::get('/lecture/create', 'lectureController@create');
Route::post('/lecture/store', 'lectureController@store');

Route::get('/venue/index', 'venuController@index');
Route::get('/venue/create', 'venuController@create');
Route::post('/venue/store', 'venuController@store');

Route::get('/lecture_instends/index', 'lectureInstanceController@index');
<<<<<<< HEAD
Route::get('/lecture_instends/create/{filter?}', 'lectureInstanceController@create');
Route::post('/lecture_instends/store', 'lectureInstanceController@store');
Route::post('/lecture_instends/auth', 'lectureInstanceController@auth');

Route::get('/lecture_instends/qrcode/{id}', 'lectureInstanceController@qrCode');
=======
Route::get('/lecture_instends/create/{filter?}/{userid?}', 'lectureInstanceController@create');
Route::post('/lecture_instends/store', 'lectureInstanceController@store');
Route::post('/lecture_instends/auth', 'lectureInstanceController@auth');

Route::get('/lecture_instends/qrcode/{id}', 'lectureInstanceController@qrCode');
Route::get('/lecture_instends/show/{id}', 'lectureInstanceController@show');
Route::post('/lecture_instends/update/{id}', 'lectureInstanceController@update');
Route::any('/lecture_instends/createTest', 'lectureInstanceController@createLectureInstance');
>>>>>>> Mobile-UI-(draft)
