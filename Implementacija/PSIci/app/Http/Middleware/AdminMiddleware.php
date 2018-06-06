<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;







class AdminMiddleware
{


    /* Author: Despotović Milica
    |-------------------------------------------------------------------------------------------|
    |  Preusmeravanje zahteva koji je dostupan samo adminu                                      |
    |-------------------------------------------------------------------------------------------|
    |                                                                                           |
    |   U slučaju da neko ko nema status admina pokuša da pristupi nekoj ruti koja              |
    |   vodi na funkcionalnost dostupnu samo adminu biće preusmeren na login stranu ukoliko     |
    |  nije prijavljen, odnosno ukoliko je gost ili na početnu stranu ukoliko                   |
    |   je prijavljen, a nema status admina. U slučaju da je trenutno prijavljen korisnik admin |
    |   njegov zahtev će biti prosleđen na rutu kojoj je želeo da pristupi.                     |
    |-------------------------------------------------------------------------------------------|
    */
    public function handle($request, Closure $next)
    {
        if (Auth::check() == false) {

            return response()->view('auth.login');
        }
        else if (Auth::user()->is_admin == false) {
            return redirect()->route('home');
        }
        else {
            return $next($request);
        }




    }
}
