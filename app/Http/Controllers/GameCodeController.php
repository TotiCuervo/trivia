<?php

namespace App\Http\Controllers;

use App\GameCode;
use App\Game;

use Illuminate\Http\Request;

use Str;

class GameCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($id)
    {

        $game = Game::findorFail($id);

        $gameCode = $game->gameCodes()->create([
            'code' => strtoupper(Str::random(5)),
            'expirationTime' => date("Y-m-d H:m:s", strtotime('+8 hours')),
        ]);


        return $gameCode;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GameCode  $gameCode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (GameCode::where('game_id', $id)->exists()) {

            $gameCode = GameCode::where('game_id', $id)->get();

            if ($gameCode[0]->expirationTime < date("Y-m-d H:m:s")) {
                $gameCode[0]->delete();
                return 'false';
            } else {
                return $gameCode;
            }
        }
        else {
            return 'false';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GameCode  $gameCode
     * @return \Illuminate\Http\Response
     */
    public function edit(GameCode $gameCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GameCode  $gameCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameCode $gameCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GameCode  $gameCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameCode $gameCode)
    {
        //
    }
}
