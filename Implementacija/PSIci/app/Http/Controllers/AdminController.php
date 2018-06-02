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
        return view('home.users', compact('users'));
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        DB::table('users')->where('id', '=', $id)->update(array('is_admin' => true));
        return redirect()->route('accountManager');
    }

    public function seriesInput()
    {
        return view('input.series');
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

        foreach ($request->zanr as $genre) {

            $type = new TypeOf();
            $type->tvshow_id = $content->id;
            $g = Category::where('name','=',$genre)->first();

            $type->genre_id = $g->id;
            $type->save();
        }
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();

        return view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));


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
            $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
            $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();

            return view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));
        }
        $category = new Category();
        $category->name = $request->actor;
        $category->save();
        $actor = new Actor();

        $actor->category_id = $category->id;

        $actor->save();
        $acting = new Acting();
        $acting->tvshow_id = $id;
        $acting->actor_id = $content->id;
        $acting->save();
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        return view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));

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
            $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
            $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();

            return view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));
        }
        $category = new Category();
        $director = new Director();
        $category->name = $request->director;
        $category->save();
        $director->category_id = $category->id;

        $director->save();
        $directing = new Directing();
        $directing->tvshow_id = $id;
        $directing->director_id = $content->id;
        $directing->save();
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        return view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));

    }

    public function seasonInput($id)
    {
        $content = Content::find($id);
        return view('input.season', compact('content'));

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
        return view('input.episode', compact('content'));

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
        return view('content.editEpisode',compact('episode','picturePaths','content'));
    }
}
