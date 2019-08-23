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
Route::get('/game/{gameCode}/code', 'GameController@getByGameCode');

Route::delete('/game/{id}/destroy', 'GameController@destroy');
Route::patch('/game/{id}', 'GameController@update');
Route::patch('/game/{id}/play', 'GameController@playOn');
Route::patch('/game/{id}/gameOver', 'GameController@playOff');
Route::get('/game/{gameCode}/teams', 'GameController@teams');
Route::get('/game/{gameCode}/teamAnswers', 'GameController@teamAnswers');

//Rounds
Route::get('/game/{id}/rounds', 'RoundController@index');
Route::get('/game/{gameCode}/roundsByCode', 'RoundController@indexByCode');
Route::post('/round/create', 'RoundController@store');
Route::patch('/round/{id}', 'RoundController@update');
Route::delete('/round/{id}/destroy', 'RoundController@destroy');

//Questions
Route::get('/question/{id}', 'QuestionController@show');
Route::get('/game/{id}/questions', 'QuestionController@index');
Route::get('/game/{gameCode}/questionsByCode', 'QuestionController@indexByCode');

Route::post('/question/create', 'QuestionController@store');
Route::patch('/question/{id}', 'QuestionController@update');
Route::delete('/question/{id}/destroy', 'QuestionController@destroy');

//Answers
Route::post('/answer/create', 'AnswerController@store');
Route::get('/game/{id}/answers', 'AnswerController@index');
Route::get('/game/{gameCode}/answersByCode', 'AnswerController@indexByCode');
Route::get('/question/{id}/answers', 'AnswerController@questionIndex');
Route::patch('/answer/{id}', 'AnswerController@update');
Route::delete('/answer/{id}/destroy', 'AnswerController@destroy');

//Play
Route::post('/play/checkCode', 'PlayController@checkCode');

//Host
Route::post('/host/{code}/startRound/{roundPosition}', 'HostController@startRound');
Route::post('/host/{code}/round/{roundPosition}/startQuestion/{questionPosition}', 'HostController@startQuestion');
Route::post('/host/{code}/roundReview', 'HostController@roundReview');
Route::post('/host/{gameCode}/round/{roundPosition}/question/{questionPosition}/currentPage/{currentPage}', 'HostController@navigateHandler');
Route::post('/host/game/{gameCode}/question/{questionPosition}/revealAnswer', 'HostController@revealAnswer');

//GameCode
Route::get('/game/{id}/gameCode', 'GameCodeController@show');
Route::post('/gameCode/{id}/create', 'GameCodeController@store');

//Teams
Route::post('/team', 'TeamLoginController@team');
Route::post('/team/logout/{id}', 'TeamLoginController@logout');
Route::post('/team/checkCode', 'TeamLoginController@checkCode');
Route::post('/team/checkIfExpired', 'TeamLoginController@checkIfExpired');
Route::post('/team/registerOrLogin', 'TeamLoginController@registerOrLogin');
Route::get('/team/{id}/pulse', 'TeamLoginController@getPulse');
Route::post('/team/{id}/answers', 'TeamAnswerController@index');

//TeamAnswers
Route::post('/teamAnswers/store', 'TeamAnswerController@store');
Route::post('/teamAnswers/{id}/updateCorrect', 'TeamAnswerController@updateCorrect');
Route::post('/team/{teamID}/round/{roundID}/powerUp/{powerUp}', 'TeamAnswerController@updatePowerUp');
Route::post('/team/{gameCode}/leaderBoard', 'TeamAnswerController@leaderBoard');

