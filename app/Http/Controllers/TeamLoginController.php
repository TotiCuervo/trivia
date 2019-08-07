<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
//    protected $hasher;
//
//    public function __construct(HashManager $hasher)
//    {
//        $this->hasher = $hasher->driver();
//    }

    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
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

    public function registerOrLogin(Request $request) {

        $teams = Team::where('gameCode', $request->gameCode)->get();

        for ($i = 0; $i < count($teams); $i++) {

            if($request->name === $teams[$i]->name) {
//                return 'trying to login';
                return $this->login($request);
            }
        }

        return $this->Register($request);

    }

    public function login(Request $request)
    {

        $credentials = array_values($request->only('name', 'password', 'provider', 'identifier'));

        if (! $team = $this->authenticator->attempt(...$credentials)) {
            throw new AuthenticationException();
        }

        $token = $team->createToken('My Token')->accessToken;

        return [
            'token_type' => 'Bearer',
            'access_token' => $token,
        ];




//        $team = Team::where('identifier', $request->name.$request->gameCode)->first();
//
//        if (! $this->hasher->check($request->password, $team->password)) {
//            return ':(';
//        }
//
//        $token = $team->createToken('My Token')->accessToken;
//
//        return [
//            'token_type' => 'Bearer',
//            'access_token' => $token,
//        ];

        //        if(Auth::guard('team')->check(['name' => $request->name, 'password' => $request->password, 'identifier' => $request->name.$request->gameCode], true)) {
////            return redirect()->intended(route('play-lobby'));
//
////            dd(Auth::guard('team')->user());
//            return 'made it';
//        }

    }

    public function register(Request $request)
    {
        $team = new Team;
        $team->name = $request->name;
        $team->gameCode = $request->gameCode;
        $team->password = bcrypt($request->password);
        $team->identifier = $request->name.$request->gameCode;

        $team->save();

        return $team;
//        return $this->login($request);
    }
}
