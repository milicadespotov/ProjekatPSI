<?php

namespace App\Http\Middleware;

use Closure;

class OnlyUserMiddleware
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
        if (Auth::check() == false)
        {
            return redirect()->back();
        }
        else if (Auth::user()->is_admin)
        {
            return redirect()->back();

        }
        else {
            return $next($request);
        }
    }
}
