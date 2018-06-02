<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    public function type_ofs(){
        return $this->hasMany('App\TypeOf', 'genre_id');
    }
    public static function getGenresNames($id) {
        return DB::table('type_ofs')
            ->join('genres','type_ofs.genre_id','=','genres.category_id')
            ->join('categories','categories.id','=','genres.category_id')
            ->where('type_ofs.tvshow_id','=',$id)
            ->select('categories.name')->get();
    }

    public static function getTVShowsSearch($text) {
        return DB::table('categories')->where('categories.name','like',$text)
            ->join('genres','genres.category_id','=','categories.id')
            ->join('type_ofs','type_ofs.genre_id','=','genres.categories_id')
            ->join('tvshows','tvshows.content_id','=','type_ofs.tvshow_id')
            ->orderby('tvshows.content_id','desc')
            ->select('tvshows.*')
            ->distinct('tvshows.*')->get();
    }

    public static function getContentsSearch($text) {
        return DB::table('categories')->where('categories.name','like',$text)
            ->join('genres','genres.category_id','=','categories.id')
            ->join('type_ofs','type_ofs.genre_id','=','genres.categories_id')
            ->join('tvshows','tvshows.content_id','=','type_ofs.tvshow_id')
            ->join('contents','contents.id','=','tvshows.content_id')
            ->orderby('content.id','desc')
            ->select('content.*')
            ->distinct('content.*')->get();
    }
}
