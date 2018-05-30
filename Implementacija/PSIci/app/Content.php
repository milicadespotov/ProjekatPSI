<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function tvshow(){
        return $this->hasOne('App\Tvshow', 'content_id');
    }

    public function season(){
        return $this->hasOne('App\Season', 'content_id');
    }

    public function episode(){
        return $this->hasOne('App\Episode', 'content_id');
    }

    public function pictures(){
        return $this->hasMany('App\Picture', 'picture_id');
    }

    public function ratings(){
        return $this->hasMany('App\Rating', 'content_id');
    }
}
