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

>>>>>>> 2f7f5d8b4b24ab07848d18564501b2f599543894
    public function mainPicture(){
        $content = DB::table('contents')->where('contents.id','=',$this->content_id);
        $picture = DB::table('pictures')->where('pictures.content_id','=',$this->content_id)->where('pictures.main_picture','=',true);
        return $picture;
    }

<<<<<<< HEAD
    public static function getTvShowsSearch($text) {
        DB::table('contents')->join('tvshows','tvshows.content_id','=','contents.id')
            ->where('contents.name','like',$text)
            ->orderby('contents.id','desc')
            ->select('tvshows.*');
    }
=======
>>>>>>> 2f7f5d8b4b24ab07848d18564501b2f599543894
}
