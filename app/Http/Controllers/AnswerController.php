<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Game;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $game = Game::findorFail($id);

        $answers = $game->answers()->get();

        return $answers;
    }

    public function questionIndex($id)
    {
        $question = Question::findorFail($id);

        $answers = $question->answers()->get();

        return $answers;

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

        $question = Question::findorFail($request->question_id);

        $answer = $question->answers()->create([
            'title' => $request->title,
            'correct' => $request->correct,
            'round_id' => $request->round_id,
        ]);

        return $answer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer = Answer::findorFail($id);

        $data = $request->data;

        $answer->title = $data['title'];
        $answer->correct = $data['correct'];

        $answer->save();

        return $answer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::findorFail($id);

        $answer->delete();
    }
}
