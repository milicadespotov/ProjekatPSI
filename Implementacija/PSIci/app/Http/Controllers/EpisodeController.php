<?php
/**
 * Created by PhpStorm.
 * User: Filip Djukic
 * Date: 31-May-18
 * Time: 15:35
 */


namespace App\Http\Controllers;
use App\Comment;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\WatchedEpisode;
use App\Episode;
use App\Content;


class EpisodeController extends Controller
{
    public function comment(Request $request){

            $comment  = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->episode_id = Input::get('episode_id');
            $comment->description = Input::get('comment');

            if(Input::get('spoiler')=='1'){
                $comment->contains_spoiler = true;
            }else{
                $comment->contains_spoiler = false;
            }

            $comment->save();
            $episode_id = Input::get('episode_id');

            $this->validate($request, [

                'comment' => 'max:255'
            ]);

            $episode = Episode::find($episode_id);

            return redirect('episode/'.$episode->content_id);//Vraca nas na izgled epizode
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


        $comment->update();//update-ovanje
        return redirect()->back();
    }

    public function updateSpoilerRemove(Request $request){
        //PROVJERITI DA LI JE $request['id'] ILI $request->id!!!!!
        $comment = Comment::where('id',$request->id)->first();

        if($comment->contains_spoiler==true){
            $comment->contains_spoiler = false;
        }


        $comment->update();//update-ovanje
        return redirect()->back();
    }

    public function updateWatched(Request $request){
        $episode_id = $request->id;

        //provjera da li je vec odgledao seriju
        //dovlacenje odgovarajuceg record-a
        $watched = DB::table('watched_episodes')->where('user_id','=',Auth::user()->id)->where('episode_id',$episode_id)->first();



        if(count($watched)!=0){
            return redirect()->back();
        }


        $watchedepisode = new WatchedEpisode();
        $watchedepisode->user_id = Auth::user()->id;
        $watchedepisode->episode_id = $episode_id;

        $watchedepisode->save();


        //PROVJERITI DA LI SU ODGLEDANE SVE EPIZODE TE SEZONE I UPDATE U SEZONU!!!
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //ostavljeno za kasnije---->DORADITI!!!!




        return redirect()->back();
    }



    public function watched(){




        $watched = DB::table('episodes')
                ->join('contents','contents.id','=','episodes.content_id')
                ->join('watched_episodes', 'episodes.content_id', '=', 'watched_episodes.episode_id')
                ->join('pictures','pictures.content_id','=','contents.id')
                ->where('pictures.main_picture','=','1')
                ->where('watched_episodes.user_id','=',Auth::user()->username)
                ->select('episodes.content_id','episodes.season_id','episodes.episode_number','contents.name','contents.release_date','contents.description','contents.rating','contents.number_of_pictures','pictures.path')
                ->orderBy('episodes.episode_number', 'asc')
                ->paginate(3);



        //mora se proslijediti varijabla view-u
        return view('content.watched_episodes',compact('watched'));
    }



    public function removeEpisode($id){

        $episode = Episode :: find($id);

       // dd($episode);

        //brisanje komentara
        DB::table('comments')->where('comments.episode_id','=',$episode->content_id)->delete();
        //brisanje iz watched_episodes
        DB::table('watched_episodes')->where('watched_episodes.episode_id','=',$episode->content_id)->delete();
        //brisanje iz pictures
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->delete();
        //brisanje iz rating
        DB::table('ratings')->where('content_id','=',$episode->content_id)->delete();

        //brisanje iz episodes
        Episode::where('content_id',$episode->content_id)->delete();
        //brisanje iz content
        Content::where('id',$episode->content_id)->delete();

        return redirect()->route('home');


    }


    public static function removeEpisodeForSeason($id){
        $episode = Episode :: find($id);

        // dd($episode);

        //brisanje komentara
        DB::table('comments')->where('comments.episode_id','=',$episode->content_id)->delete();
        //brisanje iz watched_episodes
        DB::table('watched_episodes')->where('watched_episodes.episode_id','=',$episode->content_id)->delete();
        //brisanje iz pictures
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$episode->content_id)->delete();
        //brisanje iz rating
        DB::table('ratings')->where('content_id','=',$episode->content_id)->delete();

        //brisanje iz episodes
        Episode::where('content_id',$episode->content_id)->delete();
        //brisanje iz content
        Content::where('id',$episode->content_id)->delete();
    }

}