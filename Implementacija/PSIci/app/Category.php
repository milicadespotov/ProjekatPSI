<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function genre(){
        return $this->hasOne('App\Genre', 'category_id');
    }

    public function actor(){
        return $this->hasOne('App\Actor', 'category_id');
    }

    public function director(){
        return $this->hasOne('App\Director', 'category_id');
    }
}
