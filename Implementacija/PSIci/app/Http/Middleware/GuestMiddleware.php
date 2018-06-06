<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /*-----------------------------------------------------------------------------------------|
     |      Author: Despotović Milica                                                          |
     |-----------------------------------------------------------------------------------------|
     |      Preusmeravanje zahteva koji je dostupan samo gostu                                 |
     |-----------------------------------------------------------------------------------------|
     |      U slučaju da korisnik koji nije gost (korisnik koji je prijavljen na sistem        |
     |      kao admin ili kao korisnik) pokuša da pristupi nekoj ruti kojoj samo gost sme      |
     |      da pristupi biva preusmeren na početnu stranicu. Ukoliko je korisnik gost stranica |
     |      kojoj je hteo da pristupi biće učitana.                                            |
     |                                                                                         |
     |-----------------------------------------------------------------------------------------|
     */

    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
