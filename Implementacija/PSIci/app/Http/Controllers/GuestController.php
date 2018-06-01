<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Tvshow;
use App\Content;
use App\Season;
use App\Actor;
use App\Director;
use App\Genre;
class GuestController extends Controller
{
    public function showSeries($id){
        $series = Tvshow::find($id);
        $content=Content::find($id);
        $seasons = $series->seasons;
        $type = 'series';
        $contents = DB::table('contents')->join('seasons')->where('seasons.tvshow_id', '=', $series->content_id)->where('contents.id', '=', 'seasons.content_id')->select('contents.*')->orderBy('contents.id');
        return view('content.tvshow', compact(['series', 'content', 'seasons', 'contents', 'type']));
    }

    public function showSeason($id){
        $season = Season::find($id);
        $content = Content::find($id);
        $episodes = $season->episodes;
        $type = 'season';
        $contents = DB::table('contents')->join('episodes')->where('episodes.season_id','=', $season->content_id)->where('contents.id','=','episodes.content_id')->select('contents.*')->orderBy('contents.id');
        return view('content.season', compact(['season', 'content', 'episodes', 'contents', 'type']));
    }

    public function showEpisode($id){
        $episode = Episode::find($id);
        $content = Content::find($id);
        $comments = $episode->comments;
        $path = DB::table('pictures')->where('pictures.content_id','=',$id)->where('pictures.main_picture','=',1)->select('pictures.path');
        $type = 'episode';
        return view('content.episode', compact(['comments', 'episode', 'content', 'path', 'type']));
    }

    public function search() {
        $this->validate(request(), [
            'selectionForm'=>'required',
            'search'=>'required'
        ]);
        $text = validate('search');
        $type = validate('selectionForm');
        switch($type) {
            case "na": {
                return view('home.index');
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
                $tvshows = Genre::getTVShowsSearch($text);
                $contents = Genre::getTVShowsSearch($text);
                break;
            }
        }
        $actors = array();
        $genres = array();
        $directors = array();
        foreach($tvshows as $tvshow) {
            array_push($actors,Actor::getActorsNames($tvshow->content_id));
            array_push($genres,Genre::getGenresNames($tvshow->content_id));
            array_push($directors,Director::getDirectorsNames($tvshow->content_id));
        }
    }
}