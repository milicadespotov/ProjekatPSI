<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class UserMiddleware
{
    /**
     * Author: Despotović Milica
     *          --- Preusmeravanje zahteva koji je dostupan samo registrovanom korisniku ----
     *          U slučaju da korisnik koji nije registrovan korisnik pokuša pristup nekoj od ruta
     *          koja je dostupna samo registrovanom korisniku  biće preusmeren, ukoliko je gost
     *          na stranicu login.
     *          Ukoliko je korisnik registrovan, biće mu odobren pristup stranici.
     *
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

        return $next($request);
    }
}
