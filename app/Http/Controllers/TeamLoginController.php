<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;

use App\Team;
use App\GameCode;
use App\Model\Authenticator;
use Illuminate\Auth\AuthenticationException;


use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Hashing\HashManager;



class TeamLoginController extends Controller
{

    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }


    public function team(Request $request)
    {
        return Team::where('token', $request->token)->first();

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

    public function login(Request $request)
    {
        //get the credentials
        $credentials = array_values($request->only('name', 'password', 'provider', 'identifier'));

        //attempt to authorize, if not return unauthorized
        if (! $team = $this->authenticator->attempt(...$credentials)) {
            return 'unauthorized';
        }

        if ($team->loggedIn = true) {
//            return 'alreadyLoggedIn';
        } else {
            $team->loggedIn = true;
            $team->save();
        }

        //if authorized, return the team
        return $team;

    }

    public function register(Request $request)
    {
        $team = new Team;
        $team->name = $request->name;
        $team->gameCode = $request->gameCode;
        $team->password = bcrypt($request->password);
        $team->identifier = $request->name.$request->gameCode;
        $team->token = Str::random(32);

        $team->save();

        return $team;
//        return $this->login($request);
    }
}
