<?php

use Illuminate\Support\Facades\Log;

use App\Broadcasting\GameChannel;

use Illuminate\Support\Facades\Auth;

use App\User;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Route::post('/broadcasting/auth', function (Request $req, User $user) {

    Auth::login(factory(User::class)->make([
        'id' => (int) str_replace('.', '', microtime(true)),
    ]));

    return Broadcast::auth($req);
});


Broadcast::channel('game.{gameCode}', GameChannel::class);



Broadcast::channel('channel-name', function(){
    Log::error('made it inside broadcast Channel Check');
    return true;
});

Broadcast::channel('studyDeck', function ($user) {
    return $user;
});





//Broadcast::channel('newTeam.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});