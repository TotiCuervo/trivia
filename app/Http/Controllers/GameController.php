<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameCode;
use App\User;
use App\Team;
use Illuminate\Http\Request;

use Str;
use Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findorFail($id);

        $games = $user->games()->get();

        return $games;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $user = User::findorFail($request->user_id);


        $game = $user->games()->create([
            'name' => $request->name,
            'description' => $request->description,
            'company' => $request->company,
            'headClass' => $request->headClass,
            'bodyColor' => $request->bodyColor,
            'gameCode' => Str::random(5),
        ]);

        return $game;

    }

    public function show($id)
    {
        return Game::findorFail($id);
    }

    public function getByGameCode($gameCode) {
        $game = GameCode::where('code', $gameCode)->first();

        return Game::findorFail($game->game_id);
    }

    public function edit(Game $game)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $game = Game::findorFail($id);

        $data = $request->data;

        $game->name = $data['name'];
        $game->description = $data['description'];
        $game->company = $data['company'];
        $game->headClass = $data['headClass'];
        $game->bodyColor = $data['bodyColor'];

        $game->save();

        return $game;

    }

    public function destroy($id)
    {
        $game = Game::findorFail($id);

        $game->delete();

        return $game;
    }

    public function playOn($id) {

        $game = Game::findorFail($id);

        $game->playing = true;

        $game->save();
    }

    public function playOff($id) {

        $game = Game::findorFail($id);

        $game->playing = false;

        $game->save();
    }

    public function teams($gameCode) {
        return Team::where('gameCode', $gameCode)->where('loggedIn', 1)->get();
    }
}
