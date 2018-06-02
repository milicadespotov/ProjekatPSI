<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Episode extends Model
{


     protected $primaryKey = 'content_id';


    public $PrimaryKey = 'content_id';

    public function watched_episodes(){
        return $this->hasMany('App\WatchedEpisode', 'episode_id');
    }

    public function comments(){
        $comments = Comments::where('episode_id','=',$this->content_id)->get();
        return $comments;
    }

    public function mainPicture(){

        $picture = DB::table('pictures')->where('pictures.content_id','=',$this->content_id)->where('pictures.main_picture','=','true')->select('pictures.*')->get();
       return $picture;
    }

    public function content(){

    }


}
