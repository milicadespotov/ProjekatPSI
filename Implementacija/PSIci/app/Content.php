<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Content extends Model
{
    public static function mainPictureId($id){
        $picture = DB::table('pictures')->where('pictures.content_id','=',$id)->where('pictures.main_picture','=',1)->select('pictures.*')->get()->first();

        return $picture;
    }


    public function tvshow(){
        return $this->hasOne('App\Tvshow', 'content_id');
    }

    public function season(){
        return $this->hasOne('App\Season', 'content_id');
    }

    public function episode(){
        return $this->hasOne('App\Episode', 'content_id');
    }

    public function pictures(){
        return $this->hasMany('App\Picture', 'content_id');
    }



    public function ratings(){
        return Rating::where('content_id','=',$this->id)->get();
    }

    public function averageRate()
    {
        $ratings = $this->ratings();
        $sum = 0;
        foreach ($ratings as $rating) {
            $sum = $sum + $rating->rate;
        }
        return $sum / count($ratings);
    }
    public function numberOfRates(){
        $ratings = $this->ratings();
        return count($ratings);
    }

    public function setRating(){
        $avgRate = $this->averageRate();
        $number = $this->numberOfRates();
        DB::beginTransaction();
        DB::table('contents')->where('contents.id','=', $this->id)->update(['number_of_rates'=>$number, 'rating'=>$avgRate]);
        DB::commit();
    }

    public function currentRate(){
        $rate = Rating::where('user_id','=',Auth::user()->username)->where('content_id','=',$this->id);
        $rate = $rate->first();

        return $rate;
    }

    public static function getContentsSearch($text) {
        return DB::table('contents')->join('tvshows','tvshows.content_id','=','contents.id')
            ->where('contents.name','like','%'.$text.'%')
            ->orderby('contents.id','desc')
            ->distinct()
            ->select('contents.*')->get();
    }
}
