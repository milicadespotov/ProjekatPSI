<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Director extends Model
{
    public function directings(){
        return $this->hasMany('App\Directing', 'director_id');
    }
    public static function getDirectorsNames($id) {
        return DB::table('directings')->where('directings.tvshow_id','=',$id)
            ->join('directors','directings.tvshow_id','=','directors.category_id')
            ->join('categories','categories.id','=','directors.category_id')
            ->select('categories.name')->get();
    }
    public static function getTVShowsSearch($text) {
        return DB::table('categories')->where('categories.name','like', $text)
            ->join('directors','directors.category_id','=','categories.id')
            ->join('directings','directors.category_id','=','directings.director_id')
            ->join('directings','directings.tvshow_id','=','tvshows.content_id')
            ->orderby('tvshows.content_id','desc')
            ->select('tvshows.*')
            ->distinct('tvshows.*')->get();
    }
    public static function getContentSearch($text) {
        return DB::table('categories')->where('categories.name','like', $text)
            ->join('actors','actors.category_id','=','categories.id')
            ->join('actings','actors.category_id','=','actings.actor_id')
            ->join('tvshows','actings.tvshow_id','=','tvshows.content_id')
            ->join('contents','contents.id','=','tvshows.content_id')
            ->orderby('content.id','desc')
            ->select('contents.*')
            ->distinct('contents.*')->get();
    }
}
