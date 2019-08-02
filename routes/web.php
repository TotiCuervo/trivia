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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/play', 'PlayController@index')->name('play');

Auth::routes();

Route::get('/app', 'HomeController@index')->name('home');

Route::get('/home', 'TeamController@home')->name('dashboard');

Route::get('/team/login', 'PlayController@show');

Route::post('/team/login', 'PlayController@login')->name('team-login');

Route::post('/team/login2', 'TeamController@login');

Route::get('/play', 'TeamLoginController@index')->name('play');

Route::post('/checkCode', 'TeamLoginController@checkCode')->name('checkCode');

Route::get('/play/lobby', 'TeamController@index')->name('play-lobby');