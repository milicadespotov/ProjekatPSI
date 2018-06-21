<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Facades\DB;
class ForgotPasswordController extends Controller
{
    /*Author: Despotović Milica
    |-------------------------------------------------------------------------|
    | Password Reset Controller                                               |
    |-------------------------------------------------------------------------|
    |  
    |
    |
    |
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest');
    }

    public function sendResetLinkEmail()
    {
        return view('auth.passwords.email');
    }

    public function sendEmailConfirm(Request $request)
    {
        $user = DB::table('users')->where('email', '=',$request->email)->select('users.*')->first();
        if ($user == null) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => "Korisnik sa unesenom adresom e-mail ne postoji u našoj bazi"]);
        }
        else if ($user->security_question != $request->security_question)
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(['security_question' => "Pitanje se ne poklapa sa onim koje ste uneli na svoj nalog"]);
        }
        else if ($user->answer != $request->answer)
        {
            return redirect()->back()
                ->withInput()
                ->withErrors(['answer' => "Odgovor na pitanje nije u redu" ]);

        }
        else
        {
            return redirect()->route('login');
        }
    }


}
