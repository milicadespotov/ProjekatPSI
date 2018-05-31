<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

<<<<<<< HEAD
=======


>>>>>>> d86cd7564713b1b7b12dbcc6ed2544e2a9737ff1
    public function remove($id)
    {
        $user = User::find($id);
        DB::beginTransaction();
        DB::table('comments')->where('user_id', '=', $id)->delete();
        DB::table('watched_seasons')->where('user_id', '=', $id)->delete();
        DB::table('watched_episodes')->where('user_id', '=', $id)->delete();
        DB::commit();
        $ratings = $user->ratings;
        foreach ($ratings as $rating) {
            $content_id = $rating->content_id;
            $content = Content::find($content_id);
            DB::beginTransaction();
            DB::table('ratings')->where('user_id', '=', $id)->where('content_id', '=', $content_id)->delete();
            DB::commit();
            $content->setRating;
        }
        Auth::logout();
        DB::table('users')->where('username', '=', $id)->delete();
        return view('home.index');
<<<<<<< HEAD

    }

    public function loginCheck(Request $request)
=======
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
>>>>>>> d86cd7564713b1b7b12dbcc6ed2544e2a9737ff1
        {


           $result = app('App\Http\Controller\UserController')->UserLogin(); // vraca jedan ako postoji user, nula ako ne postoji
            if ($result == 0) {

                return redirect()->back()->withInput()->withErrors(['success' => 'Korisnicko ime ili lozinka nisu u redu. Pokusajte ponovo. ']);
            } else if ($_SESSION['is_admin'] == 1) {
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
                if ($request->password == Crypt::decriptString($user->password)) {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }


                    $_SESSION['username'] = $user->username;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['surname'] = $user->surname;
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

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
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
>>>>>>> d86cd7564713b1b7b12dbcc6ed2544e2a9737ff1

        }
<<<<<<< HEAD


=======
=======
>>>>>>> 2b24d4ae7a01115fdf26155643aa95836e0b8262
>>>>>>> f33a6e7cdd2b6acbb5a5ef6d5967b3dc4548c1c2
>>>>>>> f7ee4aecb2e70d364ea16116f59077820ea03dee
>>>>>>> d86cd7564713b1b7b12dbcc6ed2544e2a9737ff1
    }






