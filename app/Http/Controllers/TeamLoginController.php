<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;
use App\GameCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class TeamLoginController extends Controller
{
    public function index()
    {
        return view('team/login');
    }

    public function checkCode(Request $request) {

        $gameCodes = GameCode::where('expirationTime', '>', date("Y-m-d H:m:s"))->get();

        for ($i = 0; $i < count($gameCodes); $i++) {

            if ($request->gameCode === $gameCodes[$i]->code) {
                return $this->registerOrLogin($request);
            }
        }

        $messages = array(
            'gameCode' => 'Sorry, this seems to be the wrong game code',
        );

        return Redirect::back()->withErrors($messages);
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

        $request->validate([
            'name' =>'required',
            'password' => 'required',
        ]);

        if(Auth::guard('team')->attempt(['name' => $request->name, 'password' => $request->password, 'identifier' => $request->name.$request->gameCode], true)) {
            return redirect()->intended(route('play-lobby'));

//            dd(Auth::guard('team')->user());
        }

        $messages = array(
            'password' => 'Sorry, wrong password :(',
        );

        return Redirect::back()->withErrors($messages);
    }

    public function register(Request $request)
    {
        $team = new Team;
        $team->name = $request->name;
        $team->gameCode = $request->gameCode;
        $team->password = bcrypt($request->password);
        $team->identifier = $request->name.$request->gameCode;

        $team->save();

        return $this->login($request);
    }
}
