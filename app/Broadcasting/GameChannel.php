<?php

namespace App\Broadcasting;
use Illuminate\Support\Facades\Log;

use App\User;

use Illuminate\Support\Facades\Auth;

class GameChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */

//    public $gameCode;

    public function __construct()
    {

    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {

//        if (Auth::user()) {
//           Log::error('there is a user here');
//        }
//        else {
//            Log::error('there is no user here');
//        }
//        return $newUser = factory(User::class)->create();

        return $user;

    }

}
