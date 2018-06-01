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
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');

    }


    public function login(Request $request)
    {


        $result = app('App\Http\Controllers\Auth\LoginController')->UserLogin($request); // vraca jedan ako postoji user, nula ako ne postoji
        if ($result == 0) {

            return redirect()->back()->withInput()->withErrors(['success' => 'Korisnicko ime ili lozinka nisu u redu. Pokusajte ponovo. ']);
        } else if (Auth::user()->is_admin == 1) {
            return redirect()->route('adminProfile');
        } else {
            return redirect()->route('userProfile');
        }


    }


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
