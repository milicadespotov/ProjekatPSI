<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function remove($id)
    {

    }

    public function SignIn(Request $request)
    {




        $result = app('App\Http\Controller\UserController')->UserSignIn(); // vraca jedan ako postoji user, nula ako ne postoji
        if ($result == 0) {

            return redirect()->back()->withInput()->withErrors(['success' => 'Korisnicko ime ili lozinka nisu u redu. Pokusajte ponovo. ']);
        }
        else if ($_SESSION['is_admin'] == 1)
        {
            return redirect()->route('adminProfile');
        }
        else
        {
            return redirect()->route('userProfile');
        }



    }




    public function userSignIn(Request $request)
    {
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if (is_null($user)) {
            return 0;
        } else {
            $is_admin = $user->is_admin;
            if ($request->password == Crypt::decriptString($user->password)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['username'] = $user->username;
                $_SESSION['name'] = $user->name;
                $_SESSION['last_name'] = $user->surname;
                $_SESSION['gender'] = $user->gender;
                $_SESSION['email'] = $user->email;
                $_SESSION['is_admin'] = $user->is_admin;

                $userForLogin = new User();
                $userForLogin->username = $user->username;
                $userForLogin->name = $user->name;
                $userForLogin->surname = $user->surname;
                $userForLogin->email = $user->email;
                $userForLogin->gender = $user->gender;
                $userForLogin->password = $user->paswword;
                $userForLogin->birth_date = $user->birth_date;
                $userForLogin->security_question = $user->security_question;
                $userForLogin->answer = $user->answer;
                $userForLogin->is_admin = $user->is_admin;
                $userForLogin->picture_path = $user->picture_path;
                $userForLogin->admin_since = $user->admin_since;
                $userForLogin->registration_date = $user->registration_date;
                Auth::login($userForLogin);

                return 1;

            }
            return 0;
        }
    }





    }
