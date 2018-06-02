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
            ->where('categories.name','like', $text)
            ->orderby('tvshows.content_id','desc')
            ->select('tvshows.*')->get();
    }
    public static function getContentSearch($text) {
        return DB::table('categories')->where('categories.name','like', $text)
            ->join('actors','actors.category_id','=','actors.id')
            ->join('actings','actors.category_id','=','actings.actor_id')
            ->join('tvshows','actings.tvshow_id','=','tvshows.content_id')
            ->join('contents','contents.content_id')
            ->orderby('content.content_id','desc')
            ->select('contents.*')
            ->distinct('contents.*')->get();
    }
}
