<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function actings(){
        return $this->hasMany('App\Acting', 'actor_id');
    }
}
