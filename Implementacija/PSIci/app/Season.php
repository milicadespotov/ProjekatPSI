<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function episodes(){
        return $this->hasMany('App\Episode', 'season_id');
    }

    public function watched_seasons(){
        return $this->hasMany('App\WatchedSeason', 'season_id');
    }

    public function watchedPercentage(){
        $array = DB::table('episodes')->join('watched_episodes','episodes.content_id','=','watched_episodes.episode_id')->where('episodes.season_id', '=', $this->content_id)->where('episodes.content_id', '=', 'watched_episodes.episode_id');
        $count = count($array);
        return $count;
    }

    public function seriesName(){
        $series = DB::table('tvshows')->where('tvshows.content_id','=',$this->tvshow_id)->first();
        $content = DB::table('contents')->where('contents.id','=',$series->content_id)->first();
        return $content->name;

    }


}
