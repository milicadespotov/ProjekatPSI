<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function rate(Request $request) {
        $this->validate(request(), [
            'ratedNum' => 'required',
            'id'=>'required'
        ]);
        $id = intval($request->id);
        $content = Content::find($id);
        if ($content==null) return;
        if (is_numeric($request->ratedNum)==false)
            return route()->back();
        $rate = Rating::where('user_id','=',Auth::user()->id)
            ->where('content_id','=',$content->id)->first();
        $ratingScore = $request->ratedNum;
        $ratingScore = intval($ratingScore);
        if ($ratingScore <= 0 || $ratingScore > 10) return view('home.index');

        if ($rate == null) {
            $rate = new Rating(['user_id'=>Auth::user()->id,
                'content_id'=>$content->id,
                'rate'=>$ratingScore
            ]);
            $rate->save();

            $content->number_of_rates = $content->numberOfRates();
            $content->rating = $content->averageRate();

            $content->update();
        } else {

            $oldRate = $rate->rate;
            $rate->rate = $ratingScore;

            DB::table('ratings')
                ->where('user_id','=',Auth::user()->id)
                ->where('content_id','=',$content->id)
                ->update(['ratings.rate'=>$ratingScore,
                    'updated_at'=>(new \Carbon\Carbon())::now()]);
            $content->rating = $content->averageRate();
            $content->update();
        }
        return response()->json(array('rating'=>$content->rating,'num'=>$content->number_of_rates));
    }
}
