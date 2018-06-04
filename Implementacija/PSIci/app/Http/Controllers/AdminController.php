<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Episode;
use App\User;
use App\Tvshow;
use App\Content;
use App\Picture;
use App\TypeOf;
use App\Actor;
use App\Director;
use App\Acting;
use App\Directing;
use App\Category;
use App\Genre;
use App\Season;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('AdminMiddleware');



    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showUsers()
    {
        $users = DB::table('users')->where('is_admin', '=', 0)->paginate(10);
        return response()->view('home.users', compact('users'));
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        DB::table('users')->where('id', '=', $id)->update(array('is_admin' => true));
        return redirect()->route('accountManager');
    }

    public function seriesInput()
    {
        return response()->view('input.series');
    }

    public function makeSeries(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required'
        ]);
        $tvshow = new Tvshow();
        $content = new Content();
        $content->name = $request->name;
        $content->trailer = $request->trailer;
        $content->release_date = $request->releaseDate;
        $content->description = $request->description;
        $content->save();
        $tvshow->content_id = $content->id;
        $tvshow->country = $request->country;
        $tvshow->language = $request->language;
        $tvshow->length = $request->duration;
        $tvshow->end_date = $request->endDate;
        $tvshow->number_of_episodes = $request->episodes;
        $tvshow->save();
        $content->save();
        if (Input::has('mainImage')) {
            $picture = new Picture();
            $picture->path = '1';
            $picture->main_picture = true;
            $picture->content_id = $content->id;
            $picture->save();
            $filename = $content->id . '-' . $picture->id . '.jpg';
            $file = $request->file('mainImage')->storeAs('img\content', $filename);

            $picture->path = $filename;

            $picture->update();

        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = false;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img\content', $filename);
                $picture->path = $filename;


                $picture->update();
            }
        }
        if ($request->zanr) {
            foreach ($request->zanr as $genre) {

                $type = new TypeOf();
                $type->tvshow_id = $content->id;
                $g = Category::where('name', '=', $genre)->first();

                $type->genre_id = $g->id;
                $type->save();
            }
        }
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();

        return response()->view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));


    }

    public function addActorWrapper(Request $request, $id){
        $this->addActor($request, $id);
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();

        return response()->view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));

    }

    public function addDirectorWrapper(Request $request, $id){
        $this->addDirector($request, $id);
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        return response()->view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));

    }

    public function addActor(Request $request, $id)
    {
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $actor = DB::table('categories')->where('categories.name', '=', $request->actor)->select('categories.*')->get()->first();
        if ($actor != null) {
            if (DB::table('actings')->where('actings.actor_id','=',$actor->id)->where('actings.tvshow_id','=',$id)->select('actings.*')->get()->first()==null) {
                $acting = new Acting();
                $acting->tvshow_id = $id;
                $acting->actor_id = $actor->id;
                $acting->save();
            }
             return;}
        $category = new Category();
        $category->name = $request->actor;
        $category->save();
        $actor = new Actor();

        $actor->category_id = $category->id;

        $actor->save();
        $acting = new Acting();
        $acting->tvshow_id = $id;
        $acting->actor_id = $category->id;
        $acting->save();


    }

    public function addDirector(Request $request, $id)
    {
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $director = DB::table('categories')->where('categories.name', '=', $request->director)->select('categories.*')->get()->first();
        if ($director != null) {
            if (DB::table('directings')->where('directings.director_id','=',$director->id)->where('directings.tvshow_id','=',$id)->select('directings.*')->get()->first()==null) {
                $directing = new Directing();
                $directing->tvshow_id = $id;
                $directing->director_id = $director->id;
                $directing->save();
            }
            return;}
        $category = new Category();
        $director = new Director();
        $category->name = $request->director;
        $category->save();
        $director->category_id = $category->id;

        $director->save();
        $directing = new Directing();
        $directing->tvshow_id = $id;
        $directing->director_id = $category->id;
        $directing->save();

    }

    public function seasonInput($id)
    {
        $content = Content::find($id);
        return response()->view('input.season', compact('content'));

    }

    public function makeSeason(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'numSeason' => 'required'
        ]);
        $season = new Season();
        $content = new Content();
        $content->name = $request->name;
        $content->trailer = $request->trailer;
        $content->release_date = $request->releaseDate;
        $content->description = $request->description;
        $content->save();
        $season->content_id = $content->id;
        $season->tvshow_id = $id;
        $season->season_number = $request->numSeason;
        $season->number_of_episodes = $request->episodes;
        $season->save();
        $content->save();
        if (Input::has('mainImage')) {
            $picture = new Picture();
            $picture->path = '1';
            $picture->main_picture = true;
            $picture->content_id = $content->id;
            $picture->save();
            $filename = $content->id . '-' . $picture->id . '.jpg';
            $file = $request->file('mainImage')->storeAs('img\content', $filename);

            $picture->path = $filename;

            $picture->update();

        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = false;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img\content', $filename);
                $picture->path = $filename;


                $picture->update();
            }
        }


        return redirect()->route('season', $content->id);
}

    public function episodeInput($id)
    {
        $content = Content::find($id);
        return response()->view('input.episode', compact('content'));

    }

    public function makeEpisode(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'numEpisode' => 'required'
        ]);
        $episode = new Episode();
        $content = new Content();
        $content->name = $request->name;
        $content->trailer = $request->trailer;
        $content->release_date = $request->releaseDate;
        $content->description = $request->description;
        $content->save();
        $episode->content_id = $content->id;
        $episode->season_id = $id;
        $episode->episode_number = $request->numEpisode;
        $episode->length = $request->duration;
        $episode->save();
        $content->save();
        if (Input::has('mainImage')) {
            $picture = new Picture();
            $picture->path = '1';
            $picture->main_picture = true;
            $picture->content_id = $content->id;
            $picture->save();
            $filename = $content->id . '-' . $picture->id . '.jpg';
            $file = $request->file('mainImage')->storeAs('img\content', $filename);

            $picture->path = $filename;

            $picture->update();

        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = false;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img\content', $filename);
                $picture->path = $filename;


                $picture->update();
            }
        }


        return redirect()->route('showepisode', $content->id);
    }

    public function editEpisode(Request $request, Episode $episode) {
        $content = Content::find($episode->content_id);
        $picturePaths = Picture::notMainPictures($episode->content_id);
        $avatarPath = Picture::mainPicture($episode->content_id);
        return response()->view('content.editEpisode',compact('avatarPath', 'episode','picturePaths','content'));
    }

    public function changeAvatar(Request $request, Content $content) {

        if ($request->typeOfOperation==0) {
            $imageExists = Picture::mainPicture($content->id);
            if ($imageExists!=null) {
                DB::table('pictures')
                    ->where('pictures.content_id','=',$content->id)
                    ->where('pictures.main_picture','=',1)
                    ->delete();
                File::delete('img\img\content\\'.$imageExists->path);
            }
        } else if ($request->typeOfOperation==1) {
            $this->validate(request(),[
                'mainImage'=>'required'
            ]);
            $imageExists = Picture::mainPicture($content->id);
            if ($imageExists==null) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = true;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file=$request->file('mainImage')->storeAs('img\content', $filename);
                $picture->path = $filename;
                $picture->update();
            } else {
                $file=$request->file('mainImage')->storeAs('img\content', $imageExists->path);

            }
        }
        return redirect()->back();
    }
    public function deletePictures(Request $request, Content $content){
        $this->validate(request(),[
            'paths'=>'required'
        ]);

        foreach($request->paths as $path) {
            DB::table('pictures')
                ->where('pictures.path','=',$path)
                ->delete();
            File::delete('img\img\content\\'.$path);
        }
        $content->update();
        return redirect()->back();
    }

    public function addPictures(Request $request, Content $content) {
        $this->validate(request(),[
            'pictures'=>'required'
        ]);
        foreach ($request->file('pictures') as $file) {
            $picture = new Picture();
            $picture->path = '1';
            $picture->content_id = $content->id;
            $picture->main_picture = false;
            $picture->save();
            $filename = $content->id . '-' . $picture->id . '.jpg';
            $file = $file->storeAs('img\content', $filename);
            $picture->path = $filename;
            $picture->update();
        }
        $content->update();
        return redirect()->back();
    }


    public function changeEpisodeData(Request $request, Episode $episode)
    {
        $this->validate(request(), [
            'name' => 'required|max:30',
            'description' => 'max:255',
            'trailer' => 'max:255'
        ]);
        if ($request->duration != null && is_numeric($request->duration) == false)
            return redirect()->back();
        $content = Content::find($episode->content_id);
        if ($request->name != null) {
            $content->name = $request->name;
        }
        if ($request->trailer != null) {
            $content->name = $request->trailer;
        }
        if ($request->description != null) {
            $content->description = $request->description;
        }
        if ($request->duration == null) {
            $episode->length = intval($request->duration);
        }
        if ($request->releaseDate) {
            $content->release_date = $request->releaseDate;
        }
        $episode->update();
        $content->update();
        return redirect()->route('showepisode', ['episode' => $episode->content_id]);
    }



    public function removeSeason($id){
        $season = Season::find($id);



        //sve epizode sezone
        $episodes = DB::table('episodes')
                    ->where('episodes.season_id','=',$id)
                    ->select('episodes.content_id')
                    ->get();


        //brisanje svih epizoda
        foreach($episodes as $episode){
            EpisodeController::removeEpisodeForSeason($episode->content_id);
        }
        //brisanje pictures
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$season->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$season->content_id)->delete();
        //brisanje iz rating
        DB::table('ratings')->where('content_id','=',$season->content_id)->delete();
        //dd($season);

        //brisanje iz seasons
        Season::where('content_id',$season->content_id)->delete();
        //brisanje iz content
        Content::where('id',$season->content_id)->delete();

        return view('home.index');
    }



    public static function removeSeasonForSeries($id){
        $season = Season::find($id);



        //sve epizode sezone
        $episodes = DB::table('episodes')
            ->where('episodes.season_id','=',$id)
            ->select('episodes.content_id')
            ->get();


        //brisanje svih epizoda
        foreach($episodes as $episode){
            EpisodeController::removeEpisodeForSeason($episode->content_id);
        }

        //brisanje pictures
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$season->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$season->content_id)->delete();
        //brisanje iz rating
        DB::table('ratings')->where('content_id','=',$season->content_id)->delete();
        //dd($season);

        //brisanje iz seasons
        Season::where('content_id',$season->content_id)->delete();
        //brisanje iz content
        Content::where('id',$season->content_id)->delete();
    }



    public function removeSeries($id){

        $series = Tvshow::find($id);

        //brisanje svih sezona
        $seasons = $series->seasons();


        foreach($seasons as $season){
            AdminController::removeSeasonForSeries($season->content_id);
        }

        //brisanje acting
        DB::table('actings')->where('actings.tvshow_id','=',$series->content_id)->delete();

        //brisanje directing
        DB::table('directings')->where('directings.tvshow_id','=',$series->content_id)->delete();

        //brisanje typeof
        DB::table('type_ofs')->where('type_ofs.tvshow_id','=',$series->content_id)->delete();

        //brisanje rating
        DB::table('ratings')->where('ratings.content_id','=',$series->content_id)->delete();

        //brisanje picture
        $pictures =  DB::table('pictures')->where('pictures.content_id','=',$series->content_id)->get();
        AdminController::deletePictureFiles($pictures);

        DB::table('pictures')->where('pictures.content_id','=',$series->content_id)->delete();

        //brisanje Tvshow
        Tvshow::where('content_id',$series->content_id)->delete();

        //brisanje content
        Content::where('id',$series->content_id)->delete();


        return view('home.index');
    }




    public static function deletePictureFiles($pictures){

        foreach($pictures as $picture){
            File::delete('img/img/content/'.$picture->path);
        }
    }

    public function editSeason(Season $season) {
        $content = Content::find($season->content_id);
        $picturePaths = Picture::notMainPictures($season->content_id);
        $avatarPath = Picture::mainPicture($season->content_id);
        return response()->view('content.editSeason',compact('avatarPath', 'season','picturePaths','content'));
    }

    public function changeSeasonData(Request $request, Season $season) {
        $this->validate(request(), [
            'name' => 'required|max:30',
            'description' => 'max:255',
            'trailer' => 'max:255'
        ]);
        if ($request->numOfEpisodes!=null) {
            //errori
        }
        $content = Content::find($season->content_id);
        if ($request->name!=null) {
            $content->name = $request->name;
        }
        if ($request->description) {
            $content->description = $request->description;
        }
        if ($request->trailer) {
            $content->trailer = $request->trailer;
        }
        if ($request->numOfEpisodes) {
            $season->number_of_episodes = $request->numOfEpisodes;
        }
        $content->update();
        $season->update();
        return redirect()->route('season',['id'=>$season->content_id]);
    }
    public function prepareCategoriesTVShow($id) {

    }
    public function editTVShow(Tvshow $tvshow) {
        $content = Content::find($tvshow->content_id);
        $picturePaths = Picture::notMainPictures($tvshow->content_id);
        $avatarPath = Picture::mainPicture($tvshow->content_id);

        $actors = Actor::getActorsNamesIds($tvshow->content_id);
        $directors = Director::getDirectorsNamesIds($tvshow->content_id);
        //checkbox
        $checkBoxArr = array();
        $allGenres = Genre::getGenresForCheckbox($tvshow->content_id);
        foreach($allGenres as $genre) {
            $check = TypeOf::checkTVShow($tvshow->content_id,$genre->id);
            array_push($checkBoxArr,['name'=>$genre->name,'check'=>$check,'id'=>$genre->id]);
        }
        return view('content.editSeries',compact('directors', 'actors', 'checkBoxArr', 'tvshow','content','picturePaths','avatarPath'));
    }
    public function changeGenres(Request $request, Tvshow $tvshow) {
        TypeOf::deleteGenres($tvshow->content_id);
        if ($request->has('genre')) {
            foreach($request->genre as $genre) {
                $type = new TypeOf();
                $type->genre_id = $genre;
                $type->tvshow_id = $tvshow->content_id;
                $type->save();
            }
        }
        return redirect()->back();
    }
    public function addEditActor(Request $request, Tvshow $tvshow) {
        $this->validate(request(), [
            'actor' => 'required|max:30'
        ]);
        $this->addActor($request, $tvshow->content_id);
        return redirect()->back();
    }
    public function addEditDirector(Request $request, Tvshow $tvshow) {
        $this->validate(request(), [
            'director' => 'required|max:30'
        ]);
        $this->addDirector($request, $tvshow->content_id);
        return redirect()->back();
    }
    public function deleteActors(Request $request, Tvshow $tvshow) {
        $this->validate(request(), [
            'actors' => 'required'
        ]);
        DB::table('actings')
            ->where('actings.tvshow_id','=',$tvshow->content_id)
            ->whereIn('actings.actor_id',$request->actors)
            ->delete();
        foreach($request->actors as $actor) {
            $check = DB::table('actings')
                ->where('actings.actor_id','=',$actor)
                ->get()
                ->first();
            if ($check==null) {
                DB::table('actors')
                    ->where('actors.category_id','=',$actor)
                    ->delete();
                DB::table('categories')
                    ->where('id','=',$actor)
                    ->delete();
            }
        }
        return redirect()->back();
    }
    public function deleteDirectors(Request $request, Tvshow $tvshow) {
        $this->validate(request(), [
            'directors' => 'required'
        ]);
        DB::table('directings')
            ->where('directings.tvshow_id','=',$tvshow->content_id)
            ->whereIn('directings.director_id',$request->directors)
            ->delete();
        foreach($request->directors as $director) {
            $check = DB::table('directings')
                ->where('directings.director_id','=',$director)
                ->get()
                ->first();
            if ($check==null) {
                DB::table('directors')
                    ->where('directors.category_id','=',$director)
                    ->delete();
                DB::table('categories')
                    ->where('id','=',$director)
                    ->delete();
            }
        }
        return redirect()->back();
    }

}
