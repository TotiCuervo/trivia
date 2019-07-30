<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

//        return $request->headClass;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::findorFail($id);
        return $game;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
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
}
