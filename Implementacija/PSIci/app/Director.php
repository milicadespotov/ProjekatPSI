<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public function directings(){
        return $this->hasMany('App\Directing', 'director_id');
    }
}
