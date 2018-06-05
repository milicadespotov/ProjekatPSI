<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Season extends Model
{

    protected $primaryKey = 'content_id';
    public function episodes(){
        return Episode::where('season_id','=', $this->content_id)->orderBy('episode_number')->get();
    }

    public function watched_seasons(){
        return $this->hasMany('App\WatchedSeason', 'season_id');
    }

    public function watchedPercentage(){
        $array = DB::table('episodes')->join('watched_episodes','episodes.content_id','=','watched_episodes.episode_id')->where('episodes.season_id', '=', $this->content_id)->where('watched_episodes.user_id','=',Auth::user()->id)->get();
        $count = count($array);
        return $count;
    }

    public function seriesName(){
        $series = DB::table('tvshows')->where('tvshows.content_id','=',$this->tvshow_id)->first();
        $content = DB::table('contents')->where('contents.id','=',$series->content_id)->first();
        return $content->name;

    }

    public function seriesId(){
        $series = DB::table('tvshows')->where('tvshows.content_id','=',$this->tvshow_id)->first();
        $content = DB::table('contents')->where('contents.id','=',$series->content_id)->first();
        return $content->id;

    }


}
