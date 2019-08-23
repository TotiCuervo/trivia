<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Events\NewTeamAnswer;
use App\Events\UpdatedAnswer;
use App\Team;
use App\TeamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TeamAnswerController extends Controller
{

    public function index($id)
    {
        return TeamAnswer::where('team_id', $id)->get();
    }

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
            'gameCode' => $request->gameCode,
            'points' => ($matchIndex == 0) ? 1 : 0,
            'question_id' => $request->question_id,
            'round_id' => $request->round_id,

        ]);

        broadcast(new NewTeamAnswer($teamAnswer));
        return $teamAnswer;

    }

    public function update(Request $request, TeamAnswer $teamAnswer)
    {
        //
    }

    public function updateCorrect($id)
    {
        $teamAnswer = TeamAnswer::findorFail($id);
        $teamAnswer->correct = !($teamAnswer->correct);
        $teamAnswer->save();
        broadcast(new UpdatedAnswer($teamAnswer));
        return $teamAnswer;
    }

    public function updatePowerUp($teamID, $roundID, $powerUp) {

        TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->update(['powerUp' => ($powerUp === 'Null') ? Null : $powerUp]);

        foreach(TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->get() as $answer) {
            $this->updatePoints($answer);
        }

        return TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->get();

    }

    public function updatePoints(TeamAnswer $answer) {

        if ($answer->correct === 1) {

            if ($answer->powerUp === 'Double') {

                $answer->points = 2;

            } elseif ($answer->powerUp === 'Triple') {

                $answer->points = 3;

            } else {

                $answer->points = 1;

            }

        } else {
            $answer->points = 0;
        }

        $answer->save();
    }


}
