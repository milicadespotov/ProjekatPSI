<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use \Crypt;
use App\User;


class LoginController extends Controller
{
    /* Author: Despotović Milica
    |-------------------------------------------------------------------------------------------------|
    | Login Controller                                                                                |
    |-------------------------------------------------------------------------------------------------|
    |                                                                                                 |
    | Ovaj kontroler pravi autentifikaciju za jednog korisnika (ukoliko su kredencijali koje je uneo  |
    | u redu) i preusmerava ga na profil. U ovom kontroleru se kreira autentifikacija koja biva       |
    | globalno dostupna, odnosno preko koje se svakog trenutnka može proveriti da li postoji trenutno |
    | registrovan korisnik i preko koje se isti može dohvatiti (njegov model).                        |
    |-------------------------------------------------------------------------------------------------|
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /* Author: Despotović Milica
    *
     *      Konstruktor kontrolera koji zabranjuje da bilo kojoj
     *      funkciji ovog kotnrolera pristupi neko ko nema status gosta.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



     /* Author: Despotović Milica
      *
      *     Funkciija koja odjavljuje korisnika i preusmerava na početnu stranicu
      *
      */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');

    }

    /* Author: Despotović Milica
    *
    *    Funkcija koja prijavljuje korisnika na sistem ukoliko
     *   je uneo ispravne kredencijale.
    */
    public function login(Request $request)
    {

        $result = app('App\Http\Controllers\Auth\LoginController')->UserLogin($request); // vraca jedan ako postoji user, nula ako ne postoji
        if ($result == 0) {

            return redirect()->back()->withInput()->withErrors(['username' => 'Korisnicko ime ili lozinka nisu u redu. Pokusajte ponovo. ']);
        } else if (Auth::user()->is_admin == 1) {
            return redirect()->route('userProfile');

        } else {
            return redirect()->route('userProfile');
        }


    }

    /* Author: Despotović Milica
    *
    *   Funkcija koja proverava da li korisnik koji se prijavljuje na sistem
    *   postoji u bazi.
    *   Takođe, proverava da li je uneo dobre kredencijale.
    */
    public function userLogin(Request $request)
    {

        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if (is_null($user)) {
            return 0;
        } else {
            $is_admin = $user->is_admin;
            $array = array('username' => $request->username, 'password' => $request->password);
            if (Auth::attempt(request(['username', 'password']))) {


                return 1;
            } else {
                return 0;
            }


        }
    }
}
