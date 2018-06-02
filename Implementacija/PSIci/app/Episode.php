<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Comment;

class Episode extends Model
{


     protected $primaryKey = 'content_id';


    public static function mainPictureId($id){
        $picture = DB::table('pictures')->where('pictures.content_id','=',$id)->where('pictures.main_picture','=',1)->select('pictures.*')->get()->first();

        return $picture;
    }

    public $PrimaryKey = 'content_id';

    public function watched_episodes(){
        return $this->hasMany('App\WatchedEpisode', 'episode_id');
    }

    public function comments(){
        $comments = Comment::where('episode_id','=',$this->content_id)->paginate(4);
        return $comments;
    }

    public function mainPicture(){

        $picture = DB::table('pictures')->where('pictures.content_id','=',$this->content_id)->where('pictures.main_picture','=',1)->select('pictures.*')->get();
       return $picture;
    }

    public function content(){

    }

    public function seriesName(){
        $series = DB::table('contents')
            ->join('tvshows', 'contents.id','=','tvshows.content_id')
            ->join('seasons','seasons.tvshow_id','=','contents.id')
            ->where('seasons.content_id','=',$this->season_id)
            ->select('contents.name')->get();
        return $series->first()->name;
    }

    public function seasonName(){
        $season = DB::table('contents')
            ->join('seasons','contents.id','=','seasons.content_id')
            ->where('seasons.content_id','=',$this->season_id)
            ->select('contents.name')->get();
        return $season->first()->name;
    }


}
