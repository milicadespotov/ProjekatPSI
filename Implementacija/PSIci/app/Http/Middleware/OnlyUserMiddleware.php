<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class OnlyUserMiddleware
{
    /**
     * Author: Despotović Milica
     *
     *   ---- Preusmeravanje zahteva koji je dostupan samo korisniku koji je prijavljen i nije administrator ----
     *        Ukoliko korisnik koji ne pripada gorenavedenoj grupi korisnika pokuša pristup
     *        ruti iz grupe koju pokriva ovaj middleware, biće preusmeren, administrator na
     *        home stranicu, gost na stranicu za prijavu na sistem.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() == false)
        {
            return response()->view('auth.login');
        }
        else if (Auth::user()->is_admin)
        {
            return redirect()->route ('home');
        }
        else {
            return $next($request);
        }
    }
}
