<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
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
        if (Auth::check() == false) {
            return respose()->view('login');
        }
        else if (Auth::user()->is_admin == false) {
            return respose()->view('user.profile');
        }
        else {
            return $next($request);
        }




    }
}
