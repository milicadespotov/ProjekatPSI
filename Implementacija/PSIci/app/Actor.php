<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Actor extends Model
{
    public function actings(){
        return $this->hasMany('App\Acting', 'actor_id');
    }
    public static function getActorsNames($id) {
        return DB::table('actings')
            ->join('actors','actings.actor_id','=','actors.category_id')
            ->join('categories','categories.id','=','actors.category_id')
            ->where('actings.tvshow_id','=',$id)
            ->select('categories.name')->get();
    }

    public static function getTVShowsSearch($text) {
        return DB::table('categories')
            ->join('actors','actors.category_id','=','categories.id')
            ->join('actings','actings.actor_id','=','actors.category_id')
            ->join('tvshows','tvshows.content_id','=','actings.tvshow_id')
            ->where('categories.name','like', '%'.$text.'%')
            ->orderby('tvshows.content_id','desc')
            ->select('tvshows.*')
            ->distinct()
            ->get();
    }
    public static function getContentSearch($text) {
        return DB::table('categories')
            ->join('actors','actors.category_id','=','categories.id')
            ->join('actings','actings.actor_id','=','actors.category_id')
            ->join('tvshows','tvshows.content_id','=','actings.tvshow_id')
            ->join('contents','contents.id','=','tvshows.content_id')
            ->where('categories.name','like', '%'.$text.'%')
            ->orderby('contents.id','desc')
            ->select('contents.*')
            ->distinct()
            ->get();
    }

    public static function getActorsNamesIds($id) {
        return DB::table('actings')
            ->join('actors','actings.actor_id','=','actors.category_id')
            ->join('categories','categories.id','=','actors.category_id')
            ->where('actings.tvshow_id','=',$id)
            ->select('categories.name','categories.id')->get();
    }
}
