<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
      //  $this->middleware('guest');
    }

    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password => required|min:6|alpha_dash',
            'password => required|min:6|alpha_dash',
            'password_confirm => required|min:6|alpha_dash'
        ]);


       $password = Hash::make($request->old_password);
        if (!Hash::check($request->old_password, Auth::user()->password))
        {

            return redirect()->back()
                ->withInput()
                ->withErrors(['old_password' => "Stari password nije ispravan"]);
        }
        else
        {
            if ($request->password != $request->password_confirm)
            {

                return redirect()->back()
                    ->withInput()
                    ->withErrors(['password' => "Lozinka koju ste uneli se ne poklapa sa potvrdom iste"]);
            }
        }
        $user = User::where('username', '=', Auth::user()->username)->first();
        $user->password = Hash::make($request->password);
        $user->update();
        return  redirect()->route('userProfile');
    }




    public function reset()
    {}



}
