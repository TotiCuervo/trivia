<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameCode;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function __construct() {
//        $this->middleware('auth:team');
//    }

    public function index()
    {
        return view('play');

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('team/testlogin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
