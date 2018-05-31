<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function showSeries($id){
        $series = TvShow::find($id);
        $content=Content::find($id);
        $seasons = $series->seasons;
        $contents = DB::table('contents')->join('seasons')->where('seasons.tvshow_id', '=', $series->content_id)->where('contents.id', '=', 'seasons.content_id')->select('contents.*')->orderBy('contents.id');
        return view('content.tvshow', compact(['series', 'content', 'seasons', 'contents']));
    }

    public function showSeason($id){
        $season = Season::find($id);
        $content = Content::find($id);
        $episodes = $season->episodes;
        $contents = DB::table('contents')->join('episodes')->where('episodes.season_id','=', $season->content_id)->where('contents.id','=','episodes.content_id')->select('contents.*')->orderBy('contents.id');
        return view('content.season', compact(['season', 'content', 'episodes', 'contents']));
    }
}
