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
}
