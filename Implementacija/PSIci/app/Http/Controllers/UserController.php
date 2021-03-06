<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\Content;
use App\Episode;
use App\User;

/** AdminController - kontroler za standardne funkcionalnosti koje mogu da koriste svi registrovani korisnici.
 *
 * @version 1.0
 */

class UserController extends Controller
{



    public function __construct()
    {
        $this->middleware('UserMiddleware');
    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja uklanja korisnikov nalog iz baze
     *
     * @param integer $id
     * @return Redirect
     */

    public function remove($id)
    {
        $user = User::where('id','=',$id);
        $user = $user->first();
        DB::beginTransaction();
        DB::table('comments')->where('user_id', '=', $id)->delete();
        DB::table('watched_seasons')->where('user_id', '=', $id)->delete();
        DB::table('watched_episodes')->where('user_id', '=', $id)->delete();
        DB::commit();
        $ratings = $user->ratings();
        foreach ($ratings as $rating) {
            $content_id = $rating->content_id;
            $content = Content::find($content_id);
            DB::table('ratings')->where('ratings.user_id','=',$id)->where('ratings.content_id','=',$content_id)->delete();
            $content->setRating();
        }
        Auth::logout();
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->route('home');

    }





    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja izvršava ocenjivanje sadržaja.
     *
     * @param Content $content
     * @param Request $request
     * @return Redirect
     */
    public function rateContent(Content $content,Request $request)
    {
        $this->validate(request(), [
            'ratedNum' => 'required'
        ]);
        if (is_numeric($request->ratedNum)==false)
            return route()->back();
        $rate = Rating::where('user_id','=',Auth::user()->id)
            ->where('content_id','=',$content->id)->first();
        $ratingScore = $request->ratedNum;
        $ratingScore = intval($ratingScore);
        if ($ratingScore <= 0 || $ratingScore > 10) return view('home.index');
        if ($rate == null) {
            $rate = new Rating(['user_id'=>Auth::user()->id,
                    'content_id'=>$content->id,
                    'rate'=>$ratingScore
                ]);
            $rate->save();

            $content->number_of_rates = $content->numberOfRates();
            $content->rating = $content->averageRate();

            $content->update();
        } else {
            $oldRate = $rate->rate;
            $rate->rate = $ratingScore;
            DB::table('ratings')
                ->where('user_id','=',Auth::user()->id)
                ->where('content_id','=',$content->id)
                ->update(['ratings.rate'=>$ratingScore,
                    'updated_at'=>(new \Carbon\Carbon())::now()]);
            $content->rating = $content->averageRate();

            $content->update();


        }
        return redirect()->back();
    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja dohvata podatke za trenutno ulogovanog korisnika
     *
     * @param
     * @return View
     */

    public function userProfile()
    {
        //dovlacenje user-a


             //$user = DB::table('users')->where('username', session()->get('username'))->first();

            $user = Auth::user();


            //dovlacenje posljednje ocijenjenih serija(tj. epizoda serija)
            //promjenljiva ce se zvati $lastRated
            //ZA PROFIL ADMINA OVO CE PREDSTAVLJATI MODIFIKOVANE SERIJE
            $lastRated = null;
            $picturesLR = null;
            if(Auth::check() && Auth::user()->is_admin==false){
            $lastRated = DB::table('tvshows')
                ->join('ratings', 'tvshows.content_id', '=', 'ratings.content_id')
                ->where('ratings.user_id','=',Auth::user()->id)
                ->select('tvshows.*')
                ->orderBy('ratings.updated_at', 'desc')
                ->limit(3)
                ->get();
            }else {
                $lastRated = DB::table('tvshows')
                    ->join('contents','contents.id','=','tvshows.content_id')
                    ->select('tvshows.*')
                    ->orderBy('contents.updated_at', 'desc')
                    ->limit(3)
                    ->get();
            }

            //dd($lastRated);

            $picturesLR = array();

            foreach($lastRated as $tvshow){
                array_push($picturesLR, Content::mainPictureId($tvshow->content_id));
            }




            //dovlacenje posljednje odgledanih serije(tj epizoda serija)
            //promjenljiva ce se zvati $lastWatched

            $lastWatched = null;
            $picturesLW = null;

            if(Auth::check() && Auth::user()->is_admin==false){
            $lastWatched = DB::table('episodes')
                ->join('watched_episodes', 'episodes.content_id', '=', 'watched_episodes.episode_id')
                ->where('watched_episodes.user_id','=',Auth::user()->id)
                ->select('episodes.*')
                ->orderBy('watched_episodes.created_at', 'desc')
                ->limit(3)
                ->get();

                $picturesLW = array();

                foreach($lastWatched as $episode){
                    array_push($picturesLW, Episode::mainPictureId($episode->content_id));
                }
            }



            //dovlacenje posljednje dodatih serija za PROFIL ADMINA

            $lastAdded = null;
            $picturesLA = null;

            if(Auth::check() && Auth::user()->is_admin==true) {

                $lastAdded = DB::table('tvshows')
                    ->select('tvshows.*')
                    ->orderBy('tvshows.created_at', 'desc')
                    ->limit(3)
                    ->get();

                $picturesLA = array();

                foreach($lastAdded as $tvshow){
                    array_push($picturesLA, Episode::mainPictureId($tvshow->content_id));
                }



            }


            return response()->view('profile.user', ['user' => $user, 'lastRated' => $lastRated, 'lastWatched' => $lastWatched,'picturesLW'=>$picturesLW,'picturesLR'=>$picturesLR,'lastAdded'=>$lastAdded,'picturesLA'=>$picturesLA]);


        }




    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja vodi na formu za azuriranje informacija o korisniku
     *
     * @param
     * @return View
     */

    public function updateInfo(){
        $user = Auth::user();
        return view('profile.user_update',['user'=>$user]);
    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja azurira informacije o korisniku na osnovu podataka proslijedjenih u formi
     *
     * @param Request $request
     * @return Redirect
     */
    public function postUpdateInfo(Request $request){



        $rules = array(

            'name' => 'max:20',
            'surname' => 'max:30',
            'email' => 'required|email|max:40'
        );


        $messages = array(
            'name.max' => 'Ime ne sme biti duže od :max slova',
            'surname.max' => 'Prezime ne sme biti duže od :max slova',
            'email.max'=>'E-mail ne sme biti duži od :max karaktera',
        );



        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }




        $user =  Auth::user();
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


            //cuvanje profilne slike
            if (Input::has('picture')) {
                $filename = $request->name . '-' . $user->username . '.jpg';
                $file = $request->file('picture')->storeAs('img\users', $filename);
                $user->picture_path = $filename;
            }

            /*
            DB::table('users')
                ->where('username',session()->get('username'))
                ->update(['name' => $newname,'surname'=>$newsurname,'email'=>$newemail,'birth_date'=>$newbdate]);*/


            $user->save();

            return redirect()->route('userProfile');

        }

}

