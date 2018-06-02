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
use Carbon\Carbon;
class GuestController extends Controller
{
    public function showSeries($content_id){
        $series = Tvshow::where('content_id', '=',$content_id);
        $series = $series->first();
        $id=$content_id;
        $content=Content::find($id);
        $seasons = $series->seasons();
        $type = 'series';
        $genres = DB::table('genres')->join('categories', 'categories.id','=','genres.category_id')->join('type_ofs','type_ofs.genre_id','=','categories.id')->where('type_ofs.tvshow_id','=',$id)->select('categories.name')->get();
        $contents = DB::table('contents')->join('seasons','seasons.content_id','=','contents.id')->where('seasons.tvshow_id', '=', $series->content_id)->select('contents.*')->get();
        return view('content.tvshow', compact(['series', 'content', 'seasons', 'contents', 'type','genres']));
    }

    public function showSeason($id){
        $season = Season::where('content_id','=',$id);
        $season = $season->first();
        $content = Content::find($id);
        $episodes = $season->episodes;
        $type = 'season';
        $contents = DB::table('contents')->join('episodes','contents.id','=','episodes.content_id')->where('episodes.season_id','=', $season->content_id)->where('contents.id','=','episodes.content_id')->select('contents.*')->orderBy('contents.id');
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

    public function search(Request $request) {
        $this->validate(request(), [
            'selectionForm'=>'required'
        ]);
        $text = $request->search;
        $type = $request->selectionForm;
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
        return view('content.search',compact('tvshows','contents','genres','directors','actors'));
    }
}