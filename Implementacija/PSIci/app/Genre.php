<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function type_ofs(){
        return $this->hasMany('App\TypeOf', 'genre_id');
    }
}
