<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Notifiable;





    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function watched_seasons(){
        return $this->hasMany('App\WatchedSeason', 'user_id');
    }

    public function watched_episodes(){
        return $this->hasMany('App\WatchedEpisode', 'user_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'user_id');
    }

    public function ratings(){
        return DB::table('ratings')->where('ratings.user_id','=',$this->id)->select('ratings.*')->get();
    }
}
