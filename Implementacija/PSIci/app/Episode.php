<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public function watched_episodes(){
        return $this->hasMany('App\WatchedEpisode', 'episode_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'episode_id');
    }
}
