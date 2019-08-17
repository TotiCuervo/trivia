<?php

namespace App\Http\Controllers;

use App\GameCode;
use App\Question;
use App\Round;
use App\Game;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $trivia = Game::findorFail($id);

        $questions = $trivia->questions()->orderBy('round_id', 'ASC')->orderBy('order_number', 'ASC')->get();

        return $questions;
    }

    public function indexByCode($gameCode)
    {
        $gameCode = GameCode::where('code', $gameCode)->first();

        $game = Game::findorFail($gameCode->game_id);

        return $game->questions()->orderBy('round_id', 'ASC')->orderBy('order_number', 'ASC')->get();
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
        $round = Round::findorFail($request->round_id);

        $question = $round->questions()->create([
            'title' => $request->title,
            'type' => $request->type,
            'order_number' => $request->order_number,
        ]);

        return $question;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findorFail($id);
        return $question;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findorFail($id);

        $data = $request->data;

        $question->title = $data['title'];
        $question->type = $data['type'];
        $question->order_number = $data['order_number'];

        $question->save();

        return $question;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findorFail($id);

        $question->delete();

        return $question;
    }
}
