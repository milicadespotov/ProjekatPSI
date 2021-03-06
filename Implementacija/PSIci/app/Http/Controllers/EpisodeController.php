<?php
/**
 * Created by PhpStorm.
 * User: Filip Djukic
 * Date: 31-May-18
 * Time: 15:35
 */


namespace App\Http\Controllers;
use App\Comment;

use App\WatchedSeason;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\WatchedEpisode;
use App\Episode;
use App\Content;


class EpisodeController extends Controller
{

    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja dodaje komentar na epizodu
     *
     * @param Request $request
     * @return Redirect
     */
    public function comment(Request $request){

            $comment  = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->episode_id = Input::get('episode_id');
            $comment->description = Input::get('comment');

            if(Input::get('spoiler')=='1'){
                $comment->contains_spoiler = true;
            }else{
                $comment->contains_spoiler = false;
            }

            $comment->save();
            $episode_id = Input::get('episode_id');

            $this->validate($request, [

                'comment' => 'max:255'
            ]);

            $episode = Episode::find($episode_id);

            return redirect('episode/'.$episode->content_id);//Vraca nas na izgled epizode
    }

    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja brise komentar sa epizode
     *
     * @param Request $request
     * @return Redirect
     */
    public function deleteComment(Request $request){
        //PROVJERITI DA LI JE $request['id'] ILI $request->id!!!!!
        DB::table('comments')->where('id',$request->id)->delete();
        //DB::commit();
        return redirect()->back();//vraca na prethodnu stranu sa koje smo dosli
    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja dodaje spoiler na komentar
     *
     * @param Request $request
     * @return Redirect
     */

    public function updateSpoiler(Request $request){
        //PROVJERITI DA LI JE $request['id'] ILI $request->id!!!!!
        $comment = Comment::where('id',$request->id)->first();

        if($comment->contains_spoiler==false){
            $comment->contains_spoiler = true;
        }


        $comment->update();//update-ovanje
        return redirect()->back();
    }

    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja sklanja spoiler sa komentara
     *
     * @param Request $request
     * @return Redirect
     */

    public function updateSpoilerRemove(Request $request){
        //PROVJERITI DA LI JE $request['id'] ILI $request->id!!!!!
        $comment = Comment::where('id',$request->id)->first();

        if($comment->contains_spoiler==true){
            $comment->contains_spoiler = false;
        }


        $comment->update();//update-ovanje
        return redirect()->back();
    }
    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja epizodu oznacava kao odgledanu
     *
     * @param Request $request
     * @return Redirect
     */

    public function updateWatched(Request $request){
        $episode_id = $request->id;

        //provjera da li je vec odgledao seriju
        //dovlacenje odgovarajuceg record-a
        $watched = DB::table('watched_episodes')->where('user_id','=',Auth::user()->id)->where('episode_id',$episode_id)->get();

        //dd($watched);

        if(count($watched)!=0){
            return redirect()->back();
        }


        $watchedepisode = new WatchedEpisode();
        $watchedepisode->user_id = Auth::user()->id;
        $watchedepisode->episode_id = $episode_id;

        $watchedepisode->save();

        //EPIZODA KOJA JE ODGLEDANA
        $episode = Episode::find($episode_id);

        $episodes = DB::table('episodes')
            ->where('season_id','=',$watchedepisode->season_id)
            ->get();

        $watchedepisodes = DB::table('episodes')
            ->join('watched_episodes','episodes.content_id','=','watched_episodes.episode_id')
            ->where('watched_episodes.user_id','=',Auth::user()->id)
            ->where('episodes.season_id','=',$watchedepisode->season_id)
            ->get();



        $watchedseason = DB::table('watched_seasons')->where('user_id','=',Auth::user()->id)->where('season_id','=',$watchedepisode->season_id)->first();

        if ($watchedseason != null) {
            if (count($episodes) == count($watchedepisodes)) {
                $watchedSeason = new WatchedSeason();
                $watchedSeason->user_id = Auth::user()->id;
                $watchedSeason->season_id = $episode->season_id;
                $watchedSeason->save();
            }
        }





        return redirect()->back();
    }


    public function updateWatchedSeason(Request $request)
    {
        $season_id = $request->id;



        //provjera da li je vec odgledao seriju
        //dovlacenje odgovarajuceg record-a
        $watched = DB::table('watched_seasons')->where('user_id','=',Auth::user()->id)->where('season_id',$season_id)->first();

        if(count($watched)!=0){
            return redirect()->back();
        }

        $watchedseason = new WatchedSeason();
        $watchedseason->user_id = Auth::user()->id;
        $watchedseason->season_id = $season_id;

        $watchedseason->save();

        //EPIZODA KOJA JE ODGLEDANA

        $episodes = Episode::where('season_id','=', $season_id)->orderBy('episode_number')->get();


        foreach ($episodes as $episode)
        {
            $watchedEpisode = $watched = DB::table('watched_episodes')->where('user_id','=',Auth::user()->id)->where('episode_id','=',$episode->content_id)->first();
            if ($watchedEpisode == null)
            {

                $watchedepisode = new WatchedEpisode();
                $watchedepisode->user_id = Auth::user()->id;
                $watchedepisode->episode_id = $episode->content_id;

                $watchedepisode->save();
            }
        }
        return redirect()->back();
    }

    public function updateUnwatchedSeason(Request $request)
    {
        $season_id = $request->id;

        $watchedseason = DB::table('watched_seasons')->where('user_id','=',Auth::user()->id)->where('season_id','=',$season_id)->first();

        if ($watchedseason == null)
        {
            return redirect()->back();
        }

        //dd($watchedseason);

        $episodes = Episode::where('season_id','=', $season_id)->orderBy('episode_number')->get();

        foreach ($episodes as $episode)
        {
            $watched = DB::table('watched_episodes')->where('user_id','=',Auth::user()->id)->where('episode_id',$episode->content_id)->get();

            if (count($watched) != 0)
            {
                $watched = DB::table('watched_episodes')->where('user_id','=',Auth::user()->id)->where('episode_id',$episode->content_id)->delete();
            }


        }
        $watchedseason = DB::table('watched_seasons')->where('user_id','=',Auth::user()->id)->where('season_id','=',$season_id)->delete();
        return redirect()->back();
    }

    public function updateUnwatched(Request $request)
    {
        $episode_id = $request->id;
        $episode = Episode::where('content_id', '=', $episode_id)->first();

        $season_id = $episode->season_id;
       $watched = DB::table('watched_episodes')->where('user_id','=',Auth::user()->id)->where('episode_id',$episode_id)->first();

       if ($watched != null) {

           $watched = DB::table('watched_episodes')->where('user_id', '=', Auth::user()->id)->where('episode_id', $episode_id)->delete();


           $watchedseason = DB::table('watched_seasons')->where('user_id', '=', Auth::user()->id)->where('season_id', '=', $season_id)->first();
           if ($watchedseason) {
               $watchedseason = DB::table('watched_seasons')->where('user_id', '=', Auth::user()->id)->where('season_id', '=', $season_id)->delete();
           }
       }
        return redirect()->back();

    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja vraća sve odgledane epizode korisnika koji je ulogovan
     *
     * @param
     * @return View
     */
    public function watched(){




        $watched = DB::table('episodes')
                ->join('contents','contents.id','=','episodes.content_id')
                ->join('watched_episodes', 'episodes.content_id', '=', 'watched_episodes.episode_id')
                ->join('pictures','pictures.content_id','=','contents.id')
                ->where('pictures.main_picture','=','1')
                ->where('watched_episodes.user_id','=',Auth::user()->id)
                ->select('episodes.content_id','episodes.season_id','episodes.episode_number','contents.name','contents.release_date','contents.description','contents.rating','contents.number_of_pictures','pictures.path')
                ->orderBy('episodes.episode_number', 'asc')
                ->paginate(3);

        //mora se proslijediti varijabla view-u
        return view('content.watched_episodes',compact('watched'));
    }



    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja brise epizodu zajedno sa njenim slikama iz baze
     *
     * @param integer $id
     * @return Redirect
     */

    public function removeEpisode($id){

        $episode = Episode :: find($id);

       // dd($episode);

        //brisanje komentara
        DB::table('comments')->where('comments.episode_id','=',$episode->content_id)->delete();
        //brisanje iz watched_episodes
        DB::table('watched_episodes')->where('watched_episodes.episode_id','=',$episode->content_id)->delete();
        //brisanje iz pictures
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->delete();
        //brisanje iz rating
        DB::table('ratings')->where('content_id','=',$episode->content_id)->delete();

        //brisanje iz episodes
        Episode::where('content_id',$episode->content_id)->delete();
        //brisanje iz content
        Content::where('id',$episode->content_id)->delete();

        return redirect()->route('home');


    }
    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja brise epizodu za potrebe sezone
     *
     * @param integer $id
     * @return Void
     */

    public static function removeEpisodeForSeason($id){
        $episode = Episode :: find($id);

        // dd($episode);

        //brisanje komentara
        DB::table('comments')->where('comments.episode_id','=',$episode->content_id)->delete();
        //brisanje iz watched_episodes
        DB::table('watched_episodes')->where('watched_episodes.episode_id','=',$episode->content_id)->delete();
        //brisanje iz pictures
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->delete();
        //brisanje iz rating
        DB::table('ratings')->where('content_id','=',$episode->content_id)->delete();

        //brisanje iz episodes
        Episode::where('content_id',$episode->content_id)->delete();
        //brisanje iz content
        Content::where('id',$episode->content_id)->delete();
    }

}