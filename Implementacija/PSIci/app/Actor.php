<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function actings(){
        return $this->hasMany('App\Acting', 'actor_id');
    }
    public static function getActorsNames($id) {
        return DB::table('actings')->where('actings.tvshow_id','=',$id)
            ->join('actors','actings.actor_id','=','actors.category_id')
            ->join('categories','categories.id','=','actors.category_id')
            ->select('categories.name');
    }

    public static function getTVShowsSearch($text) {
        return DB::table('categories')->where('categories.name','like', $text)
            ->join('actors','actors.category_id','=','categories.categories_id')
            ->join('actings','actors.category_id','=','actings.actor_id')
            ->join('actings','actings.tvshow_id','=','tvshows.content_id')
            ->orderby('tvshows.content_id','desc')
            ->select('tvshows.*')
            ->distinct('tvshows.content_id');
    }
    public static function getContentSearch($text) {
        return DB::table('categories')->where('categories.name','like', $text)
            ->join('actors','actors.category_id','=','actors.id')
            ->join('actings','actors.category_id','=','actings.actor_id')
            ->join('tvshows','actings.tvshow_id','=','tvshows.content_id')
            ->join('contents','contents.content_id')
            ->orderby('content.content_id','desc')
            ->select('contents.*')
            ->distinct('contents.*');
    }
}
