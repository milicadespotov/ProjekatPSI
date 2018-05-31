<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tvshow extends Model
{
    public function seasons(){
        return $this->hasMany('App\Season', 'tvshow_id')->orderBy('season_number');
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

<<<<<<< HEAD

=======
    public function mainPicture(){
        $content = DB::table('contents')->where('contents.id','=',$this->content_id);
        $picture = DB::table('pictures')->where('pictures.content_id','=',$this->content_id)->where('pictures.main_picture','=',true);
        return $picture;
    }
>>>>>>> e5f924f466b55314e00b08ba527185a98cf5e276
}
