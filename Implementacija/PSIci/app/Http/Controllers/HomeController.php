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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
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
            $upcoming = DB::table('contents')
                        ->join('tvshows','contents.id','=','content_id')
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
}
