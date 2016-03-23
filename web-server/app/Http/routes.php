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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::group(array('middleware' => 'auth'), function () {

    Route::get('/qa', function () {
        return view('qa');
    });

    Route::get('/qa/now', 'QuestionAndAwnersController@show');
    Route::get('/qa/feedback', 'QuestionAndAwnersController@index');

    Route::get('/qa/previous', function () {
        return view('qa-previous');
    });


    Route::get('/now', function () {
        return view('now');
    });

    Route::get('/timetable', 'lectureController@timetable');

    Route::get('/attendance', function () {
        return view('attendance');
    });

    Route::get('/qr', 'qrCodeController@show');

    Route::get('/overall', 'attendanceController@index');
    Route::get('/overall/lecture', 'attendanceController@showLecture');
    Route::get('/overall/self', 'attendanceController@show');


    Route::get('/admin/attendance', 'attendanceController@index');

    Route::get('/now', function () {
        return view('now');
    });

    Route::get('/attendance', function () {
        return view('attendance');
    });

    Route::get('/users', 'AuthController@users');
});

Route::group(array("prefix" => "api", "middleware" => "apiSignIn"), function () {

    Route::post('/auth/index', 'AuthController@index');
    Route::post('/auth/create', 'AuthController@create');
    Route::post('/auth/store', 'AuthController@store');
    Route::post('/auth/logout', 'AuthController@logout');


    Route::post('/couse/index', 'courseController@index');
    Route::post('/couse/create', 'courseController@create');
    Route::post('/couse/store/', 'courseController@store');

    Route::post('/lecture/index/{filter?}', 'lectureController@index');
    Route::post('/lecture/create', 'lectureController@create');
    Route::post('/lecture/store', 'lectureController@store');

    Route::post('/venue/index', 'venuController@index');
    Route::post('/venue/create', 'venuController@create');
    Route::post('/venue/store', 'venuController@store');

    Route::post('/lecture_instends/index', 'lectureInstanceController@index');
    Route::post('/lecture_instends/create/{filter?}', 'lectureInstanceController@create');
    Route::post('/lecture_instends/store', 'lectureInstanceController@store');
    Route::post('/lecture_instends/auth', 'lectureInstanceController@auth');
    Route::post('/lecture_instends/authUser', 'lectureInstanceController@authUser');
    Route::post('/lecture_instends/status', 'lectureInstanceController@status');
    Route::post('/lecture_instends/attendes', 'lectureInstanceController@attends');
    Route::post('/lecture_instends/show/{id}', 'lectureInstanceController@show');

    Route::post('/quiz/studentQuiz', 'quizController@ansQuiz');
    Route::post('/quiz/lectureQuiz', 'quizController@startNstop');
    Route::post('/quiz/lectureShow', 'quizController@show');

});

Route::post('api/auth/login', 'AuthController@login');


Route::any('/login', 'AuthController@login');

Route::any('/logout', 'AuthController@logout');


Route::get('/auth/index', 'AuthController@index');
Route::get('/auth/create', 'AuthController@create');
Route::post('/auth/store', 'AuthController@store');
Route::post('/auth/update/{id?}', 'AuthController@update');
Route::post('/auth/destroy', 'AuthController@destroy');
Route::post('/auth/update', 'AuthController@update');
Route::post('/auth/show', 'AuthController@show');
Route::get('/auth/logout', 'AuthController@logout');


Route::get('/couse/index', 'courseController@index');
Route::get('/couse/create', 'courseController@create');
Route::post('/couse/store/', 'courseController@store');

Route::get('/lecture/index/{filter?}', 'lectureController@index');
Route::get('/lecture/create', 'lectureController@create');
Route::post('/lecture/store', 'lectureController@store');

Route::get('/venue/index', 'venuController@index');
Route::get('/venue/create', 'venuController@create');
Route::post('/venue/store', 'venuController@store');

Route::get('/lecture_instends/index', 'lectureInstanceController@index');

Route::get('/lecture_instends/create/{filter?}/{userid?}', 'lectureInstanceController@create');
Route::post('/lecture_instends/store', 'lectureInstanceController@store');
Route::post('/lecture_instends/auth', 'lectureInstanceController@auth');


Route::get('/lecture_instends/qrcode/{id}', 'lectureInstanceController@qrCode');
Route::post('/lecture_instends/update/{id}', 'lectureInstanceController@update');
Route::any('/lecture_instends/createTest', 'lectureInstanceController@createLectureInstance');
