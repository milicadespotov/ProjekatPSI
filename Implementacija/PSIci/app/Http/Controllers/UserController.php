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

use App\User;


class UserController extends Controller
{



    public function __construct()
    {
        $this->middleware('UserMiddleware');
    }

    public function remove($id)
    {
        $user = User::where('username','=',$id);
        DB::beginTransaction();
        DB::table('comments')->where('user_id', '=', $id)->delete();
        DB::table('watched_seasons')->where('user_id', '=', $id)->delete();
        DB::table('watched_episodes')->where('user_id', '=', $id)->delete();
        DB::commit();
        $user = $user->first();
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








    public function rateContent(Content $content,Request $request)
    {
        $rate = Rating::where('user_id','=',Auth::user()->username)
            ->where('content_id','=',$content->id)->first();
        $ratingScore = $request->ratedNum;
        $ratingScore = intval($ratingScore);
        if ($ratingScore <= 0 || $ratingScore > 10) return view('home.index');
        if ($rate == null) {
            $rate = new Rating(['user_id'=>Auth::user()->username,
                    'content_id'=>$content->id,
                    'rate'=>$ratingScore
                ]);
            $sum = $content->number_of_rates * $content->rating + $ratingScore;
            $content->number_of_rates = $content->number_of_rates + 1;
            $content->rating = $sum / $content->number_of_rates;
            $rate->save();
            $content->update();
        } else {
            $oldRate = $rate->rate;
            $sum = $content->number_of_rates * $content->rating - $oldRate + $ratingScore;
            $content->rating = $sum / $content->number_of_rates;
            $rate->rate = $ratingScore;
            $content->update();
            DB::table('ratings')
                ->where('user_id','=',Auth::user()->username)
                ->where('content_id','=',$content->id)
                ->update(['ratings.rate'=>$ratingScore,
                    'updated_at'=>(new \Carbon\Carbon())::now()]);

        }

        return redirect()->back();
    }



    public function userProfile()
    {
        //dovlacenje user-a


             //$user = DB::table('users')->where('username', session()->get('username'))->first();

        $user = Auth::user();


            //dovlacenje posljednje ocijenjenih serija(tj. epizoda serija)
            //promjenljiva ce se zvati $lastRated
            $lastRated = DB::table('tvshows')
                ->join('ratings', 'tvshows.content_id', '=', 'ratings.content_id')
                ->select('tvshows.*')
                ->orderBy('ratings.updated_at', 'asc')
                ->limit(3)
                ->get();
            //dovlacenje posljednje odgledanih serije(tj epizoda serija)
            //promjenljiva ce se zvati $lastWatched
            $lastWatched = DB::table('episodes')
                ->join('watched_episodes', 'episodes.content_id', '=', 'watched_episodes.episode_id')
                ->select('episodes.*')
                ->orderBy('watched_episodes.created_at', 'asc')
                ->limit(3)
                ->get();


            return view('profile.user', ['user' => $user, 'lastRated' => $lastRated, 'lastWatched' => $lastWatched]);

        }






    public function updateInfo(){
        $user = DB::table('users')->where('username',session()->get('username'))->first();
        return view('profile.user_update',['user'=>$user]);
    }

    public function postUpdateInfo(Request $request){
        $user =  User::where('username', '=', session()->get('username'))->first();
        //stare vrijednosti za polja
        $oldusername = $user->username;
        $oldname = $user->name;
        $oldsurname = $user->surname;
        $oldemail = $user->email;
        $oldgender = $user->gender;
        $oldbdate = $user->birth_date;


        $newname = $request['name'];
        $newsurname = $request['surname'];
        $newemail = $request['email'];
        $newgender = $request['gender'];
        $newbdate = $request['birth_date'];



        //provjera da li je email jedinstven
        if($oldemail != $newemail) {
            $existingMailUser = DB::table('users')//user sa istim e-mailom kao novi
            ->where('email', $newemail)
                ->get();

            if (count($existingMailUser) != 0) {
                return redirect()->back()->withInput()->withErrors(array('email' => 'Ovaj email je vec zauzet!'));
            }
        }
            $this->validate($request, [

                'name' => 'max:20',
                'surname' => 'max:30',
                'email' => 'email|max:30'
            ]);





            //polja koja ne smiju biti prazna

            if ($newname != '') {
                $user->name = $newname;
            }
            if ($newsurname != '') {
                $user->surname = $newsurname;
            }
            if ($newemail != '') {
                $user->email = $newemail;
            }

            $user->gender = $newgender;
            $user->birth_date = $newbdate;

            DB::table('users')
                ->where('username',session()->get('username'))
                ->update(['name' => $newname,'surname'=>$newsurname,'email'=>$newemail,'birth_date'=>$newbdate]);
            
            
           // $user->save();//PROBATI I SA $user->update() !!!!!!

            return redirect()->route('userProfile');



        }



}

