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

class GuestController extends Controller
{
    public function showSeries($content_id){
        $series = Tvshow::where('content_id', '=',$content_id);
        $series = $series->first();
        $id=$content_id;
        $content=Content::find($id);
        $seasons = $series->seasons;
        $type = 'series';
        $contents = DB::table('contents')->join('seasons','seasons.content_id','=','contents.id')->where('seasons.tvshow_id', '=', $series->content_id)->where('contents.id', '=', 'seasons.content_id')->select('contents.*')->orderBy('contents.id');
        return view('content.tvshow', compact(['series', 'content', 'seasons', 'contents', 'type']));
    }

    public function showSeason($id){
        $season = Season::find($id);
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
}