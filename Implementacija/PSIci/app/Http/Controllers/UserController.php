<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function remove($id){
        $user = User::find($id);
        DB::beginTransaction();
        DB::table('comments')->where('user_id','=',$id)->delete();
        DB::table('watched_seasons')->where('user_id','=',$id)->delete();
        DB::table('watched_episodes')->where('user_id','=',$id)->delete();
        DB::commit();
        $ratings = $user->ratings;
        foreach($ratings as $rating){
            $content_id = $rating->content_id;
            $content = Content::find($content_id);
            DB::beginTransaction();
            DB::table('ratings')->where('user_id','=', $id)->where('content_id', '=',$content_id)->delete();
            DB::commit();
            $content->setRating;
        }
        Auth::logout();
        DB::table('users')->where('username', '=',$id)->delete();
        return view('home.index');
    }
}
