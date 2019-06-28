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

Route::post('/game/create', 'GameController@store')->middleware('auth:api');
Route::get('/games/{id}', 'GameController@index');
Route::get('/trivia/{id}', 'GameController@show');

Route::get('/trivia/{id}/rounds', 'RoundController@index');
Route::post('/round', 'RoundController@store');

Route::get('/trivia/{id}/questions', 'QuestionController@index');
Route::post('/question/create', 'QuestionController@store');

Route::post('/answer/create', 'AnswerController@store');
Route::get('/trivia/{id}/answers', 'AnswerController@index');



//Route::prefix('api')->group(function () {
//    Route::get('/trivia/{id}', 'GameController@show');
//
//});