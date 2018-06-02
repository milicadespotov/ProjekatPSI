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
        return DB::table('directings')
            ->join('directors','directings.director_id','=','directors.category_id')
            ->join('categories','categories.id','=','directors.category_id')
            ->where('directings.tvshow_id','=',$id)
            ->select('categories.name')->get();
    }
    public static function getTVShowsSearch($text) {
        return DB::table('categories')
            ->join('directors','directors.category_id','=','categories.id')
            ->join('directings','directors.category_id','=','directings.director_id')
            ->join('tvshows','directings.tvshow_id','=','tvshows.content_id')
            ->where('categories.name','like', '%'.$text.'%')
            ->orderby('tvshows.content_id','desc')
            ->select('tvshows.*')
            ->get();
    }
    public static function getContentSearch($text) {
        return DB::table('categories')
            ->join('directors','directors.category_id','=','categories.id')
            ->join('directings','directors.category_id','=','directings.director_id')
            ->join('tvshows','directings.tvshow_id','=','tvshows.content_id')
            ->join('contents','contents.id','=','tvshows.content_id')
            ->where('categories.name','like', '%'.$text.'%')
            ->orderby('contents.id','desc')
            ->select('contents.*')
            ->get();
    }
}
