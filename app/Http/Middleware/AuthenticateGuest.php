<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;


class AuthenticateGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        Log::error($request);
        Auth::login(factory(User::class)->make([
            'id' => (int) str_replace('.', '', microtime(true)),
            'name' => 'poop mcstuffins'
        ]));

        return $next($request);
    }
}
