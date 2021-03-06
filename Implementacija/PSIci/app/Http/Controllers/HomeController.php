<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Tvshow;
use App\Content;
use App\Season;
use App\Episode;
use App\Actor;
use App\Picture;
use App\Director;
use App\Genre;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja vraća najpopularnije i predstojece serije za potrebe pccetne stranice
     *
     * @param
     * @return View
     */
    public function index()
    {
        //najpopularnije serije



            $mostPopular = DB::table('contents')
                            ->join('tvshows','contents.id','=','content_id')
                            ->select('contents.name','contents.description','contents.id')
                            ->orderBy('contents.rating','desc')
                            ->limit(3)
                            ->get();


            $picturesMP = array();
            foreach($mostPopular as $tvshow){
                $mainPic = DB::table('pictures')
                                ->where('pictures.content_id','=',$tvshow->id)
                                ->where('pictures.main_picture','=',1)
                                ->select('pictures.path')
                                ->get()
                                ->first();

                array_push($picturesMP,$mainPic);
            }

            //dd($picturesMP);
        //predstojece serije

            $currentDate = \Carbon\Carbon::now();
            $upcoming = DB::table('contents')
                        ->join('tvshows','contents.id','=','content_id')
                        ->where('contents.release_date','>',$currentDate->toDateTimeString())
                        ->select('contents.name','contents.description','contents.id')
                        ->orderBy('contents.release_date','desc')
                        ->limit(3)
                        ->get();


            $picturesUpcoming = array();
            foreach($upcoming as $tvshow){
                $mainPic = DB::table('pictures')
                    ->where('pictures.content_id','=',$tvshow->id)
                    ->where('pictures.main_picture','=',1)
                    ->select('pictures.path')
                    ->get()
                    ->first();

                array_push($picturesUpcoming,$mainPic);
            }


        return view('home.index',compact(['mostPopular','picturesMP','upcoming','picturesUpcoming']));
    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja vraća najbolje ocijenjene serije
     *
     * @param
     * @return View
     */
        public function mostPopular(){

            $mostPopular = DB::table('contents')
                ->join('tvshows','contents.id','=','content_id')
                ->select('contents.name','contents.description','contents.id','contents.release_date','contents.rating','contents.number_of_pictures')
                ->orderBy('contents.rating','desc')
                ->paginate(5);


            $picturesMP = array();
            foreach($mostPopular as $tvshow){
                $mainPic = DB::table('pictures')
                    ->where('pictures.content_id','=',$tvshow->id)
                    ->where('pictures.main_picture','=',1)
                    ->select('pictures.path')
                    ->get()
                    ->first();

                array_push($picturesMP,$mainPic);
            }



            return view('content.most_popular',compact(['mostPopular','picturesMP']));
        }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja vraća predstojece serije
     *
     * @param integer $id
     * @return Picture
     */
        public function upcoming(){

            $currentDate = \Carbon\Carbon::now();

            $upcoming = DB::table('contents')
                ->join('tvshows','contents.id','=','content_id')
                ->where('contents.release_date','>',$currentDate->toDateTimeString())
                ->select('contents.name','contents.description','contents.id','contents.release_date','contents.rating','contents.number_of_pictures')
                ->orderBy('contents.release_date','asc')
                ->paginate(5);



            $picturesUpcoming = array();
            foreach($upcoming as $tvshow){
                $mainPic = DB::table('pictures')
                    ->where('pictures.content_id','=',$tvshow->id)
                    ->where('pictures.main_picture','=',1)
                    ->select('pictures.path')
                    ->get()
                    ->first();

                array_push($picturesUpcoming,$mainPic);
            }

            return view('content.upcoming',compact(['upcoming','picturesUpcoming']));
        }
}
