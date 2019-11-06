<?php

namespace App\Http\Controllers;

use App\Events\NewTeam;
use App\Events\UpdateTeams;
use App\Events\TeamLeaving;
use Illuminate\Http\Request;

use Str;

use App\Team;
use App\User;
use App\Game;
use App\GameCode;
use App\Model\Authenticator;
use Illuminate\Auth\AuthenticationException;


use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\Facades\Log;




class TeamLoginController extends Controller
{

    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }


    public function team(Request $request)
    {
        $team = Team::where('token', $request->token)->first();

        $team->loggedIn = 1;
        $team->save();

        return $team;

    }

    public function index()
    {
        return view('team/login');
    }

    public function checkCode(Request $request) {

        $gameCodes = GameCode::where('expirationTime', '>', date("Y-m-d H:m:s"))->get();

        for ($i = 0; $i < count($gameCodes); $i++) {

            if ($request->code === $gameCodes[$i]->code) {
                return 'true';
            }
        }

        return 'false';
    }

    public function checkIfExpired(Request $request)
    {
        $team = Team::where('token', $request->token)->first();

        if (! GameCode::where('code', $team->gameCode)->exists()) {
            return 'expired';
        }
        else {
            $team->loggedIn = 1;

            $team->save();

            $this->broadcastNewTeam($team);

            return $team;
        }
    }

    public function registerOrLogin(Request $request) {

        //if this team exists log them in
        if ($teams = Team::where('gameCode', $request->gameCode)->where('name', $request->name)->first()) {
            return $this->login($request);
        }

        //if not, register them
        return $this->Register($request);

    }

    public function register(Request $request)
    {
        //creates the team
        $team = new Team;
        $team->name = $request->name;
        $team->gameCode = $request->gameCode;
        $team->password = bcrypt($request->password);
        $team->identifier = $request->name.$request->gameCode;
        $team->token = Str::random(32);
        $team->loggedIn = true;

        //adds to database
        $team->save();

        //triggers event
        $this->broadcastNewTeam($team);

        //returns team
//        return Team::findorFail($team->id);
        return $this->retrieveGameData($team->id);

    }

    public function login(Request $request)
    {
        //get the credentials
        $credentials = array_values($request->only('name', 'password', 'provider', 'identifier'));

        //attempt to authorize, if not return unauthorized
        if (! $team = $this->authenticator->attempt(...$credentials)) {
            return 'unauthorized';
        }

        //if they are loggedIn, do not let them in
        if ($team->loggedIn === 1) {
            return 'alreadyLoggedIn';
        }
        //if not logged in, let them in
        else {
            $team->loggedIn = true;
            $team->save();
        }

        //triggers event
        $this->broadcastNewTeam($team);

        //if authorized, return the team
//        return Team::findorFail($team->id);


        return $this->retrieveGameData($team->id);

    }

    public function retrieveGameData($id) {

        $team = Team::findorFail($id);

        $game = Game::findorFail(GameCode::where('code', $team->gameCode)->first()->game_id);

        $info = array (
            'team' => $team,
            'game' => $game,
            'rounds' => $game->rounds()->orderBy('order_number', 'ASC')->get(),
            'questions' => $game->questions()->orderBy('round_id', 'ASC')->orderBy('order_number', 'ASC')->get(),
            'answers' => $game->answers()->get(),
            'teamAnswers' => $team->teamAnswers()->get(),
        );

        return $info;

    }






    public function logout($id){
        Log::error('made it to logout');

        $team = Team::findorFail($id);
        $team->loggedIn = false;
        $team->save();

        $this->broadcastTeamLeaving($team);

        return $team;
    }

    public function edit($id, Request $request) {

        $team = Team::findorFail($id);
        $team->name = $request->name;
        $team->save();

        $teams = Team::where('gameCode', $team->gameCode)->get();

        broadcast(new UpdateTeams($teams, $team->gameCode));

        return $teams;

    }

    public function delete($id) {
        $team = Team::findorFail($id);

        $gameCode = $team->gameCode;

        $team->delete();

        $teams = Team::where('gameCode', $gameCode)->get();

        broadcast(new UpdateTeams($teams, $gameCode));

        return $teams;


    }

    //broadcasts
    public function broadcastNewTeam($team) {
        $broadTeam = Team::where('identifier', $team->identifier)->first();
        return broadcast(new NewTeam($broadTeam));
    }

    public function broadcastTeamLeaving($team) {
        Log::error('made it to TeamLeaving broadcat');
        $broadTeam = Team::where('identifier', $team->identifier)->first();
        return broadcast(new TeamLeaving($broadTeam));
    }

    public function getPulse($id) {
        return Team::findorFail($id)->first()->loggedIn;
    }

    public function iAmHere($id) {
        $team = Team::findorFail($id);
        $team->loggedIn = true;
        $team->save();
    }

}
