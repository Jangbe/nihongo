<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('beranda');
// });
// Route::get('/huruf', 'KotobasController@huruf');
Route::get('/', function(){return view('beranda');});
Route::get('/prepolakalimat', 'KotobasController@prepola');
Route::post('/polakalimat', 'KotobasController@pola');
Route::post('/terjemah', 'KotobasController@terjemah');
Route::get('/prequiz', 'KotobasController@prequiz');
Route::post('/prequiz', 'KotobasController@setquiz');
Route::get('/quiz', 'KotobasController@quiz');
Route::get('/quiz/{no}', 'KotobasController@quiz');
Route::post('/quiz', 'KotobasController@next');
Route::post('/getquiz', 'KotobasController@getquiz');
Route::post('/quizz', 'KotobasController@check');
Route::post('/quizz/check', 'KotobasController@result');
Route::get('/result', 'KotobasController@hasil');
Route::post('/pagination', 'KotobasController@page');
Route::post('/time', 'KotobasController@time');

//untuk quiz huruf
Route::get('/prequiz-huruf', 'QuizController@prequiz')->middleware('soal:back');
Route::post('/prequiz-huruf', 'QuizController@setquiz');
Route::get('/quiz-huruf', 'QuizController@quiz')->middleware('soal:next');
Route::get('/quiz-huruf/{no}', 'QuizController@quiz')->middleware('soal:next');
Route::post('/quiz-huruf/jawab', 'QuizController@jawab');
Route::post('/quiz-next', 'QuizController@next');
Route::post('/quiz-huruf/check', 'QuizController@check');
Route::post('/time-huruf', 'QuizController@time');
Route::get('/result-huruf', 'QuizController@result')->middleware('soal:next');

//untuk login admin
Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin', 'AdminsController@index');
    Route::get('/addkotoba', 'AdminsController@store');
    Route::post('/addkotoba', 'AdminsController@create');
    Route::get('/addpola', 'AdminsController@addpola');
    Route::post('/addpola', 'AdminsController@createpola');
});
Route::get('/login', 'AuthsController@index');
Route::post('/login', 'AuthsController@login');
Route::get('/daftar', 'AuthsController@daftar');
Route::post('/daftar', 'AuthsController@signup');
Route::get('logout', 'AuthsController@logout');
