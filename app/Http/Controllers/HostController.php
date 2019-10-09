<?php

namespace App\Http\Controllers;

use App\Events\AreYouThere;
use App\Events\NextStep;
use App\Events\UpdateTime;
use App\Events\StartQuestion;
use App\Events\StartRound;
use App\Events\RoundReview;
use App\Events\RevealAnswer;

use App\Team;

use App\Round;

use Illuminate\Http\Request;

class HostController extends Controller
{

//    public function startRound($code, $roundPosition) {
//
//        broadcast(new StartRound($code, $roundPosition));
//        return 'Start Round Successful';
//    }
//
//    public function startQuestion($code, $roundPosition, $questionPosition) {
//        broadcast(new StartQuestion($code, $roundPosition, $questionPosition));
//        return 'startQuestion Successful';
//    }
//
//    public function roundReview($code) {
//        broadcast(new RoundReview($code));
//        return 'roundReview Successful';
//    }

    public function revealAnswer($gameCode, $questionPosition) {
        broadcast(new RevealAnswer($gameCode, $questionPosition));
        return 'revealAnswer Succcessful!';
    }

    public function navigateHandler($code, $roundPosition, $questionPosition, $currentPage) {
        broadcast(new NextStep($code, $roundPosition, $questionPosition, $currentPage));
        return 'success';
    }

    public function updateTime($code, $teamID, $time) {
        broadcast(new UpdateTime($teamID, $time, $code));
    }

    public function areYouThere($gameCode) {
        Team::where('gameCode', $gameCode)->update(['loggedIn' => false]);
        broadcast(new AreYouThere($gameCode));
    }


}
