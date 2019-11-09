<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Events\NewTeamAnswer;
use App\Events\UpdatedAnswer;
use App\Events\UpdateTeams;
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
            'points' => 1,
            'question_id' => $request->question_id,
            'round_id' => $request->round_id,

        ]);

        if ($teamAnswer->correct === 1) {
            $this->addPointsToTeam($teamAnswer, 1);
        }

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

        if ($teamAnswer->correct) {
            $this->addPointsToTeam($teamAnswer, $teamAnswer->points);
        } else {
            $this->addPointsToTeam($teamAnswer, 0 - $teamAnswer->points);
        }

        broadcast(new UpdatedAnswer($teamAnswer));

        return Team::findorFail($teamAnswer->team_id);
    }

    public function updatePowerUp($teamID, $roundID, $powerUp) {

//      Get the teamAnswers
        $teamAnswers = TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->get();

//      get the team
        $team = Team::where('id', $teamID)->first();

//      change the teams powerUp to true depending on the powerUp
        if ($powerUp === 'Double') {
            $team->double = true;
        } else if ($powerUp === 'Triple') {
            $team->triple = true;
        }

//      update the team answers to reflect the powerUp
        TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->update(['powerUp' => $powerUp]);

//      get the answers again
        $teamAnswers = TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->get();

//      update the answers based on the powerUp
        foreach($teamAnswers as $answer) {
            $this->updatePoints($answer);
        }

        $team->save();

        return $team;

    }

    public function undoPowerUp($teamID, $roundID, $powerUp) {

//      get all the team answers
        $teamAnswers = TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->get();

//      get the team
        $team = Team::where('id', $teamID)->first();

//      update the team based on the powerUp
        if ($powerUp === 'Double') {
            $team->double = false;
        } else if ($powerUp === 'Triple') {
            $team->triple = false;
        }

//      go through each answer, update the team points
        foreach($teamAnswers as $answer) {
            if ($answer->correct) {
                Log::error('made it to the place');
                $this->addPointsToTeam($answer, 1 - $answer->points);
            }
        }

//      change the powerUp on each answer for that round
        TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->update(['powerUp' =>  Null ]);

        //get the answers again
        $teamAnswers = TeamAnswer::where('team_id', $teamID)->where('round_id', $roundID)->get();

//      update the point depending on the powerUp that was changed
        foreach($teamAnswers as $answer) {
            $this->updatePoints($answer);
        }

        $team->save();

        return $team;

    }

    public function updatePoints(TeamAnswer $answer) {

        if ($answer->powerUp === 'Double') {
            $answer->points = 2;

            if ($answer->correct) {
                $this->addPointsToTeam($answer, 1);
            }

        } elseif ($answer->powerUp === 'Triple') {
            $answer->points = 3;
            if ($answer->correct) {
                $this->addPointsToTeam($answer, 2);
            }

        } else {

            $answer->points = 1;
        }

        $answer->save();
    }

    public function addPointsToTeam(TeamAnswer $answer, $points) {
        $team = Team::where('id', $answer->team_id)->first();
        Log::error('$team->points = $team->points + $points;');
        Log::error($team->points);
        Log::error($points);

        $team->points = $team->points + $points;

        $team->save();

        return $team;
    }

    public function leaderBoard ($gameCode) {

        $teams = Team::where('gameCode', $gameCode)->orderBy('points', 'desc')->get();

        Log::error('Here are the teams:');
        Log::error($teams);

        broadcast(new UpdateTeams($teams, $gameCode));

        return $teams;

    }










}
