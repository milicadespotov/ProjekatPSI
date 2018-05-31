<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{
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
        return $this->hasMany('App\Picture', 'picture_id');
    }

    public function ratings(){
        return $this->hasMany('App\Rating', 'content_id');
    }

    public function averageRate()
    {
        $ratings = $this->ratings;
        $sum = 0;
        foreach ($ratings as $rating) {
            $sum = $sum + $rating->rate;
        }
        return $sum / count($ratings);
    }
    public function numberOfRates(){
        $ratings = $this->ratings;
        return count($ratings);
    }

    public function setRating(){
        $avgRate = $this->averageRate;
        $number = $this->numberOfRates;
        DB::beginTransaction();
        DB::table('contents')->where('contents.id','=', $this->id)->update(['number_of_rates'=>$number, 'rating'=>$avgRate]);
        DB::commit();
    }

    public function currentRate(){
        $rate = DB::table('ratings')->where('user_id','=',Auth::user()->username)->where('content_id','=',$this->id);
        if ($rate==null) return null;
        return $rate;
    }
}
