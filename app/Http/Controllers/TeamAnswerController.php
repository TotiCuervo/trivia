<?php

namespace App\Http\Controllers;

use App\Answer;
use App\TeamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TeamAnswerController extends Controller
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
    public function store(Request $request)
    {
        $answers = Answer::where('question_id', $request->question_id)->where('correct', true)->get();

        $matchIndex = 1000;

        $answerPosition = 0;

        foreach ($answers as $key=>$answer) {

            $lev = levenshtein($request->answer, $answer->title);

            if ($lev == 0) {

                $matchIndex = 0;
                $answerPosition = $key;

                // break out of the loop; we've found an exact match
                break;
            }

            if ($lev < $matchIndex) {
                $matchIndex = $lev;
            }

        }

        $teamAnswer = TeamAnswer::create([
            'team_id' => $request->team_id,
            'answer' => $request->answer,
            'correct' => ($matchIndex == 0) ? $answers[$answerPosition]->correct : false,
            'matchIndex' => $matchIndex,
            'points' => ($matchIndex == 0) ? 1 : 0,
            'question_id' => $request->question_id,

        ]);

        return $teamAnswer;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamAnswer  $teamAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(TeamAnswer $teamAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamAnswer  $teamAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamAnswer $teamAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamAnswer  $teamAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamAnswer $teamAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamAnswer  $teamAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamAnswer $teamAnswer)
    {
        //
    }
}
