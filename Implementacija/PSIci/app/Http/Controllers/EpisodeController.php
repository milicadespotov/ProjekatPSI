<?php
/**
 * Created by PhpStorm.
 * User: Filip Djukic
 * Date: 31-May-18
 * Time: 15:35
 */


namespace App\Http\Controllers;
use App\Comment;
use App\WatchedEpisode;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\User;

class EpisodeController extends Controller
{
    public function comment(){
            if(session_status()==PHP_SESSION_NONE){
                session_start();
            }

            $comment  = new Comment;
            $comment->user_id = $_SESSION['username'];
            $comment->episode_id = Input::get('episode_id');
            $comment->description = Input::get('comment');

            if(Input::get('spoiler')==='1'){
                $comment->contains_spoiler = true;
            }else{
                $comment->contains_spoiler = false;
            }

            $comment->save();

            $episode = DB::table('episodes')->where('content_id',Input::get('episode_id'));

            return redirect('episode/'.$episode->content_id.'');//Vraca nas na izgled epizode
    }

    public function deleteComment(Request $request){
        //PROVJERITI DA LI JE $request['id'] ILI $request->id!!!!!
        DB::table('comments')->where('id',$request->id)->delete();
        //DB::commit();
        return redirect()->back();//vraca na prethodnu stranu sa koje smo dosli
    }


    public function updateSpoiler(Request $request){
        //PROVJERITI DA LI JE $request['id'] ILI $request->id!!!!!
        $comment = Comment::where('id',$request->id)->first();

        if($comment->contains_spoiler==false){
            $comment->contains_spoiler = true;
        }


        $comment->save();
        return redirect()->back();
    }

    public function updateWatched(Request $request){
        $episode_id = $request->id;

        //provjera da li je vec odgledao seriju
        //dovlacenje odgovarajuceg record-a
        $watched = DB::table('watched_episodes')->where('user_id',$_SESSION['username'])->where('episode_id',$episode_id)->first();

        if(!is_null($watched)){
            return redirect()->back();
        }

        $watched = new WatchedEpisode;
        $watched->user_id = $_SESSION['username'];
        $watched->episode_id = $episode_id;

        $watched->save();


        //PROVJERITI DA LI SU ODGLEDANE SVE EPIZODE TE SEZONE I UPDATE U SEZONU!!!
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!





        return redirect()->back();
    }


}