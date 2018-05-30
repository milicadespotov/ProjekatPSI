<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tvshow extends Model
{
    public function seasons(){
        return $this->hasMany('App\Season', 'tvshow_id');
    }

    public function actings(){
        return $this->hasMany('App\Acting', 'tvshow_id');
    }

    public function type_ofs(){
        return $this->hasMany('App\TypeOf', 'tvshow_id');
    }

    public function directings(){
        return $this->hasMany('App\Directing', 'tvshow_id');
    }
}
