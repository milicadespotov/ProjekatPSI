<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
<<<<<<< HEAD


     protected $primaryKey = 'content_id';

=======
    public $PrimaryKey = 'content_id';
>>>>>>> ee52f4570b2c057f696a909ec984cebf9e18a29a
    public function watched_episodes(){
        return $this->hasMany('App\WatchedEpisode', 'episode_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'episode_id');
    }

    public function mainPicture(){
        $content = DB::table('contents')->where('contents.id','=',$this->content_id);
        $picture = DB::table('pictures')->where('pictures.content_id','=',$this->content_id)->where('pictures.main_picture','=',true);
        return $picture;
    }

    public function content(){

    }


}
