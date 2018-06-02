<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tvshow extends Model
{

    public $PrimaryKey = 'content_id';
    public function seasons(){
        return Season::where('tvshow_id','=', $this->content_id)->get();
    }


    public function actors(){
        $actors = DB::table('actors')->join('categories','categories.id','=','actors.category_id')->join('actings','actors.category_id','=','actings.actor_id')->where('actings.tvshow_id','=',$this->content_id)->select('categories.*')->get();
        return $actors;
    }

    public function type_ofs(){
        return $this->hasMany('App\TypeOf', 'tvshow_id');
    }

    public function directors(){
        $directors = DB::table('directors')->join('categories','categories.id','=','directors.category_id')->join('directings','directors.category_id','=','directings.director_id')->where('directings.tvshow_id','=',$this->content_id)->select('categories.*')->get();
        return $directors;
    }



    public function mainPicture(){
        $content = DB::table('contents')->where('contents.id','=',$this->content_id);
        $picture = DB::table('pictures')->where('pictures.content_id','=',$this->content_id)->where('pictures.main_picture','=',true);
        return $picture;
    }


    public static function getTvShowsSearch($text) {
        return DB::table('contents')->join('tvshows','tvshows.content_id','=','contents.id')
            ->where('contents.name','like','%'.$text.'%')
            ->orderby('contents.id','desc')
            ->select('tvshows.*')->get();
    }

}
