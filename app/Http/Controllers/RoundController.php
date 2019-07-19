<?php

namespace App\Http\Controllers;

use App\Game;
use App\Round;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $trivia = Game::findorFail($id);

        $rounds = $trivia->rounds()->get();

        return $rounds;
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
        $trivia = Game::findorFail($request->game_id);

        $round = $trivia->rounds()->create([
            'game_id' => $request->game_id,
            'order_number' => $request->order_number,
            'title' => $request->title,
            'time' => $request->time,
            'round_type' => $request->round_type,
        ]);

        return $round;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Round $round)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function edit(Round $round)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $round = Round::findorFail($id);

        $data = $request->data;

        $round->title = $data['title'];
        $round->time = $data['time'];
        $round->order_number = $data['order_number'];

        $round->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $round = Round::findorFail($id);
        $round->delete();
        return $round;
    }
}
