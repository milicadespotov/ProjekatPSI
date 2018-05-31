<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\Content;

class UserController extends Controller
{



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

    public function rateSeries(Content $content) {
        if ($content==null) return view('home.index');
        $rate=Rating::find($_SESSION['username'],$content->id);
        $ratingScore = request('ratedNum');
        $ratingScore = intval($ratingScore);
        if ($ratingScore<=0 || $ratingScore>10) return view('home.index');
        if ($rate==null) {
            DB::table('rating')->insert(array('user_id'=>$_SESSION['username'],'content_id'=>$content->id,'rate'=>$ratingScore));
            $sum = $content->number_of_rates*$content->rating+$ratingScore;
            $content->number_of_rates=$content->number_of_rates+1;
            $content->rating = $sum / $content->number_of_rates;
            $content->save();
        } else {
            $oldRate = $rate->rate;
            $sum = $content->number_of_rates*$content->rating-$oldRate+$ratingScore;
            $content->rating = $sum / $content->number_of_rates;
            $rate->rate = $ratingScore;
            $content->save();
            $rate->save();
        }

    }


}
