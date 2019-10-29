<?php

namespace App\Http\Controllers;

use App\Events\WhereAreWe;
use App\Events\NewTeam;

use App\Game;
use App\GameCode;
use App\Team;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class PlayController extends Controller
{

    public function checkCode(Request $request) {

        $gameCodes = GameCode::where('expirationTime', '>', date("Y-m-d H:m:s"))->get();

        for ($i = 0; $i < count($gameCodes); $i++) {

            if ($request->code === $gameCodes[$i]->code) {
                return 'true';
            }
        }

        return 'false';
    }

    public function login(Request $request) {

        $request->validate([
            'name' =>'required',
            'password' => 'required',
        ]);

        if(Auth::guard('team')->attempt(['name' => $request->name, 'password' => $request->password], true)) {

//            return response()->json(Auth::team(),200);

//            return response()->json('made it', 200);

            return redirect()->intended(route('dashboard'));


        }

        return 'not logged in';
    }

    public function whereAreWe($teamID) {
        broadcast(new NewTeam(Team::findOrFail($teamID)));
    }
}
