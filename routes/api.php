<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Game
Route::post('/game/create', 'GameController@store')->middleware('auth:api');
Route::get('/games/{id}', 'GameController@index');
Route::get('/game/{id}', 'GameController@show');

//Rounds
Route::get('/trivia/{id}/rounds', 'RoundController@index');
Route::post('/round/create', 'RoundController@store');
Route::patch('/round/{id}', 'RoundController@update');
Route::delete('/round/{id}/destroy', 'RoundController@destroy');

//Questions
Route::get('/question/{id}', 'QuestionController@show');
Route::get('/trivia/{id}/questions', 'QuestionController@index');
Route::post('/question/create', 'QuestionController@store');
Route::patch('/question/{id}', 'QuestionController@update');
Route::delete('/question/{id}/destroy', 'QuestionController@destroy');


//Answers
Route::post('/answer/create', 'AnswerController@store');
Route::get('/game/{id}/answers', 'AnswerController@index');
Route::get('/question/{id}/answers', 'AnswerController@questionIndex');
Route::patch('/answer/{id}', 'AnswerController@update');
Route::delete('/answer/{id}/destroy', 'AnswerController@destroy');





//Route::prefix('api')->group(function () {
//    Route::get('/trivia/{id}', 'GameController@show');
//
//});
