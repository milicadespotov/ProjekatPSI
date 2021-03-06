<?php

namespace App\Http\Controllers;

use App\WatchedEpisode;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Tvshow;
use App\Content;
use App\Season;
use App\Episode;
use App\Actor;
use App\Picture;
use App\Director;
use App\Genre;
use Carbon\Carbon;
/** GuestController - kontroler za funkcionalnosti dostupne neulogovanom korisniku
 *
 * @version 1.0
 */
class GuestController extends Controller
{
    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja preusmerava na stranicu sa prikazom određene serije
     *
     * @param integer $content_id
     * @return Response
     */
    public function showSeries($content_id){
        $series = Tvshow::where('content_id', '=',$content_id);
        $series = $series->first();
        $id=$content_id;
        $content=Content::find($id);
        $seasons = $series->seasons();
        $type = 'series';
        $genres = DB::table('genres')->join('categories', 'categories.id','=','genres.category_id')->join('type_ofs','type_ofs.genre_id','=','categories.id')->where('type_ofs.tvshow_id','=',$id)->select('categories.name')->get();
        $contents = DB::table('contents')->join('seasons','seasons.content_id','=','contents.id')->where('seasons.tvshow_id', '=', $series->content_id)->select('contents.*')->get();
        return response()->view('content.tvshow', compact(['series', 'content', 'seasons', 'contents', 'type','genres']));
    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja preusmerava na stranicu sa prikazom određene sezone
     *
     * @param integer $id
     * @return Response
     */

    public function showSeason($id){
        $season = Season::where('content_id','=',$id);
        $season = $season->first();
        $content = Content::find($id);

        $episodes = $season->episodes();

        //$episodes = $season->episodes;


        $type = 'season';
        $contents = DB::table('contents')->join('episodes','episodes.content_id','=','contents.id')->where('episodes.season_id','=',$id)->select('contents.*')->orderBy('episodes.episode_number')->get();


        $isWatched = null;
        $tmp = -1;
        if (Auth::check()) {
            $watched = DB::table('watched_seasons')->where('season_id', '=', $id)->where('user_id', '=', Auth::user()->id)->select('season_id')->get();
            $tmp=0;
        }
        if ($tmp!=-1 && count($watched) != 0)
        {
            $isWatched = 1;
        }

        //dd($contents);



          return response()->view('content.season', compact(['season', 'content', 'episodes', 'contents', 'type', 'isWatched']));

    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja preusmerava na stranicu sa prikazom određene epizode
     *
     * @param integer $id
     * @return Response
     */

    public function showEpisode($id){
        $episode = Episode::where('content_id','=',$id);
        $episode = $episode->first();
        $content = Content::find($id);


        $path = DB::table('pictures')->where('pictures.content_id','=',$id)->where('pictures.main_picture','=',1)->select('pictures.path');

        $comments = $episode->comments();
        $pictures = Picture::where('content_id',$id)->get();
        $path = Picture::where('pictures.content_id','=',$id)->where('pictures.main_picture','=',1)->select('pictures.path');

        $numcomments = count($comments);
        $type = 'episode';
        $isWatched = null;
        $tmp=-1;
        if (Auth::check()) {
            $watched = DB::table('watched_episodes')->where('episode_id', '=', $id)->where('user_id', '=', Auth::user()->id)->select('episode_id')->get();
            $tmp=0;
        }
        if ($tmp!=-1 && count($watched) != 0)
        {
            $isWatched = 1;
        }
        //dd($isWatched);

        return response()->view('content.episode', compact(['comments', 'episode', 'content', 'path', 'type','pictures','numcomments','isWatched']));
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja izvršava pretragu i prikazuje rezultat pretrage.
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request) {
        $this->validate(request(), [
            'selectionForm'=>'required'
        ]);
        $text = $request->search;
        $type = $request->selectionForm;
        switch($type) {
            case "na": {
                return redirect()->route('home');
            }
            case "serija": {
                $tvshows = Tvshow::getTvShowsSearch($text);
                $contents = Content::getContentsSearch($text);
                break;
            }
            case "glumci":{
                $tvshows = Actor::getTVShowsSearch($text);
                $contents = Actor::getContentSearch($text);
                break;
            }
            case "reziseri":{
                $tvshows = Director::getTVShowsSearch($text);
                $contents = Director::getContentSearch($text);
                break;
            }
            default: {
                $tvshows = Genre::getTVShowsSearch($type, $text);

                $contents = Genre::getContentsSearch($type, $text);
                break;
            }
        }


        $actors = array();
        $actors = array();
        $genres = array();
        $directors = array();
        $pictures = array();
        foreach($tvshows as $tvshow) {
            array_push($actors, Actor::getActorsNames($tvshow->content_id));
            array_push($genres, Genre::getGenresNames($tvshow->content_id));
            array_push($directors, Director::getDirectorsNames($tvshow->content_id));
            array_push($pictures, \App\Picture::mainPicture($tvshow->content_id));
        }
        return response()->view('content.search',compact('tvshows','contents','genres','directors','actors','pictures'));
    }
}