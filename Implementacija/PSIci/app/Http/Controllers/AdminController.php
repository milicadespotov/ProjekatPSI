<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
use PharIo\Manifest\RequiresElementTest;

/** AdminController - kontroler za funkcionalnosti dostupne samo administratoru
 *
 * @version 1.0
 */

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

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja unapredjuje korisnika u administratora
     *
     * @param integer $id
     * @return Redirect
     */

    public function makeAdmin($id)
    {
        $user = User::find($id);
        DB::table('users')->where('id', '=', $id)->update(array('is_admin' => true));
        return redirect()->route('accountManager');
    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja prikazuje administratoru formu za unos informacija o novoj seriji
     *
     * @param
     * @return Response
     */

    public function seriesInput()
    {
        return response()->view('input.series');
    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja kreira novu seriju i ubacuje je u bazu
     *
     * @param Request $request
     * @return Redirect
     */

    public function makeSeries(Request $request)
    {

        $rules=array(
            'name' => 'required'

        );
        $messages = array(
            'name.required'=>'Ovo polje je obavezno!'
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ((!(ctype_digit($request->episodes)) || (ctype_digit($request->episodes) && ($request->episodes<0))) && $request->episodes!=null){
            return redirect()->back()
                ->withErrors(['episodes'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput();
        }

        if ((!ctype_digit($request->duration) || (ctype_digit($request->duration) && $request->duration<0)) && $request->duration!=null){
            return redirect()->back()
                ->withErrors(['duration'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput();
        }


        $tvshow = new Tvshow();
        $content = new Content();
        $content->name = $request->name;
        if ($request->trailer) {
        $trailer = explode('=', $request->trailer);
        $content->trailer = $trailer[1];} else
            $content->trailer = $request->trailer;
        $content->release_date = $request->releaseDate;
        $content->description = $request->description;
        if (Input::has('mainImage'))
        {
            $content->number_of_pictures++;
        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $content->number_of_pictures++;
            }
        }
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
            $file = $request->mainImage;
            if ($request->hasFile('mainImage')) {

                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img/content', $filename);
                $picture->path = $filename;
                $picture->update();
            }







        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = false;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img/content', $filename);
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

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja poziva funkciju za dodavanje glumca u bazu i preusmerava na dalji unos glumaca i režisera
     *
     * @param Request $request, integer $id
     * @return Response
     */

    public function addActorWrapper(Request $request, $id){
        $this->addActor($request, $id);
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();

        return response()->view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));

    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja poziva funkciju za dodavanje režisera u bazu i preusmerava na dalji unos glumaca i režisera
     *
     * @param Request $request, integer $id
     * @return Response
     */

    public function addDirectorWrapper(Request $request, $id){
        $this->addDirector($request, $id);
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $actors = DB::table('categories')->join('actings', 'actings.actor_id','=','categories.id')->where('actings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        $directors = DB::table('categories')->join('directings','directings.director_id','=','categories.id')->where('directings.tvshow_id', '=', $content->id)->select('categories.name')->get();
        return response()->view('input.actorsAndDirectors', compact('content', 'tvshow', 'actors', 'directors'));

    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija za dodavanje glumca u bazu
     *
     * @param Request $request, integer $id
     * @return void
     */

    public function addActor(Request $request, $id)
    {
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $actor = DB::table('actors')->join('categories','actors.category_id','=','categories.id')->where('categories.name', '=', $request->actor)->select('categories.*')->get()->first();
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

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija za dodavanje režisera u bazu
     *
     * @param Request $request, integer $id
     * @return void
     */

    public function addDirector(Request $request, $id)
    {
        $content = Content::find($id);
        $tvshow = Tvshow::where('content_id','=',$id)->first();
        $director = DB::table('directors')->join('categories','directors.category_id','=','categories.id')->where('categories.name', '=', $request->director)->select('categories.*')->get()->first();
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

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja preusmerava na stranicu za unos informacija o novoj sezoni
     *
     * @param integer $id
     * @return Response
     */

    public function seasonInput($id)
    {
        $content = Content::find($id);
        return response()->view('input.season', compact('content'));

    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja kreira novu sezonu i ubacuje je u bazu
     *
     * @param Request $request, integer $id
     * @return Redirect
     */

    public function makeSeason(Request $request, $id)
    {
        $rules=array(
            'name' => 'required',
            'numSeason' => 'required|integer|min:1',
        );
        $messages = array(
            'name.required'=>'Ovo polje je obavezno!',
            'numSeason.required' => 'Ovo polje je obavezno!',
            'numSeason.integer'=>'Ovo polje mora biti pozitivan ceo broj!',
            'numSeason.min' =>'Ovo polje mora biti pozitivan ceo broj!'
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'episodes'=>$request->episodes, 'numSeason'=>$request->numSeason

                    ]);
        }

        if ((!ctype_digit($request->episodes) || (ctype_digit($request->episodes) && $request->episodes<0)) && $request->episodes!=null){
            return redirect()->back()
                ->withErrors(['episodes'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'episodes'=>$request->episodes, 'numSeason'=>$request->numSeason

                ]);
        }

        if (Season::where('tvshow_id','=',$id)->where('season_number','=',$request->numSeason)->get()->first()!=null) {
            return redirect()->back()
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'episodes'=>$request->episodes, 'numSeason'=>$request->numSeason

                ])
                ->withErrors(['numSeason' => "Sezona sa ovim rednim brojem već postoji!"]);
        }
        $season = new Season();
        $content = new Content();
        $content->name = $request->name;
        if ($request->trailer) {
            $trailer = explode('=', $request->trailer);
            $content->trailer = $trailer[1];} else
            $content->trailer = $request->trailer;
        $content->release_date = $request->releaseDate;
        $content->description = $request->description;
        if (Input::has('mainImage'))
        {
            $content->number_of_pictures++;
        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $content->number_of_pictures++;
            }
        }
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
            $file = $request->mainImage;
            if ($request->hasFile('mainImage')) {

                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img/content', $filename);
                $picture->path = $filename;
                $picture->update();
            }

        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = false;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img/content', $filename);
                $picture->path = $filename;


                $picture->update();
            }
        }


        return redirect()->route('season', $content->id);
}

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja preusmerava na stranicu za unos informacija o novoj epizodi
     *
     * @param integer $id
     * @return Response
     */

    public function episodeInput($id)
    {
        $content = Content::find($id);
        return response()->view('input.episode', compact('content'));

    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja kreira novu epizodu i ubacuje je u bazu
     *
     * @param Request $request, integer $id
     * @return Redirect
     */

    public function makeEpisode(Request $request, $id)
    {
        $rules=array(
            'name' => 'required',

        );
        $messages = array(
            'name.required'=>'Ovo polje je obavezno!',


        );


        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'duration'=>$request->duration, 'numEpisode'=>$request->numEpisode

                ]);
        }

        if ((!ctype_digit($request->numEpisode) || (ctype_digit($request->numEpisode) && $request->numEpisode<0)) && $request->numEpisode!=null){
            return redirect()->back()
                ->withErrors(['numEpisode'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'episodes'=>$request->episodes, 'numSeason'=>$request->numSeason

                ]);
        }

        if ((!ctype_digit($request->duration) || (ctype_digit($request->duration) && $request->duration<0)) && $request->duration!=null){
            return redirect()->back()
                ->withErrors(['duration'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'episodes'=>$request->episodes, 'numSeason'=>$request->numSeason

                ]);
        }


        if (Episode::where('season_id','=',$id)->where('episode_number','=',$request->numEpisode)->get()->first()!=null) {
            return redirect()->back()
                ->withInput(['id'=>$id, 'trailer'=>$request->trailer, 'name'=>$request->name,
                    'description'=>$request->description, 'releaseDate'=>$request->releaseDate,
                    'duration'=>$request->duration, 'numEpisode'=>$request->numEpisode

                ])
                ->withErrors(['numEpisode' => "Epizoda sa ovim rednim brojem već postoji!"]);
        }


        $episode = new Episode();
        $content = new Content();
        $content->name = $request->name;
        if ($request->trailer) {
            $trailer = explode('=', $request->trailer);
            $content->trailer = $trailer[1];} else
            $content->trailer = $request->trailer;
        $content->release_date = $request->releaseDate;
        $content->description = $request->description;
        if (Input::has('mainImage'))
        {
            $content->number_of_pictures++;
        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $content->number_of_pictures++;
            }
        }
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
            $file = $request->mainImage;
            if ($request->hasFile('mainImage')) {

                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img/content', $filename);
                $picture->path = $filename;
                $picture->update();
            }

        }
        if ($request->pictures) {
            foreach ($request->file('pictures') as $file) {
                $picture = new Picture();
                $picture->path = '1';
                $picture->content_id = $content->id;
                $picture->main_picture = false;
                $picture->save();
                $filename = $content->id . '-' . $picture->id . '.jpg';
                $file = $file->storeAs('img/content', $filename);
                $picture->path = $filename;


                $picture->update();
            }
        }


        return redirect()->route('showepisode', $content->id);
    }

    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje ažuran prikaz trenutnog stanja epizode koju administrator želi da menja.
     *
     * @param Request $request
     * @param Episode $episode
     * @return Response
     */
    public function editEpisode(Request $request, Episode $episode) {
        $content = Content::find($episode->content_id);
        $picturePaths = Picture::notMainPictures($episode->content_id);
        $avatarPath = Picture::mainPicture($episode->content_id);
        return response()->view('content.editEpisode',compact('avatarPath', 'episode','picturePaths','content'));
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje promenu naslovne slike epizode, sezone ili serije.
     *
     * @param Request $request
     * @param Content $content
     * @return Redirect
     */
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
                $file = $request->mainImage;
                if ($request->hasFile('mainImage')) {

                    $filename = $content->id . '-' . $picture->id . '.jpg';
                    $file = $file->storeAs('img/content', $filename);
                    $picture->path = $filename;
                    $picture->update();
                }
            } else {
                $file = $request->mainImage;
                if ($request->hasFile('mainImage')) {

                    $file=$request->file('mainImage')->storeAs('img\content', $imageExists->path);

                }

            }
        }
        return redirect()->back();
    }

    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje brisanje slika koje je administrator dodao epizodi, sezoni ili seriji.
     *
     * @param Request $request
     * @param Content $content
     * @return Redirect
     */
    public function deletePictures(Request $request, Content $content){
        $this->validate(request(),[
            'paths'=>'required'
        ]);

        foreach($request->paths as $path) {
            DB::table('pictures')
                ->where('pictures.content_id','=',$content->id)
                ->where('pictures.path','=',$path)
                ->delete();
            File::delete('img\img\content\\'.$path);
        }
        $content->update();
        return redirect()->back();
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje dodavanje slika epizodi, sezoni ili seriji.
     *
     * @param Request $request
     * @param Content $content
     * @return Response
     */
    public function addPictures(Request $request, Content $content) {
        $this->validate(request(),[
            'pictures'=>'required'
        ]);
        foreach ($request->file('pictures') as $file) {
            $content->number_of_pictures++;
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

    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje promenu trenutnog stanja epizode.
     *
     * @param Request $request
     * @param Episode $episode
     * @return Redirect
     */
    public function changeEpisodeData(Request $request, Episode $episode)
    {
        $rules=array(
            'name' => 'required',
            'numEpisode' => 'required|integer|min:1'

        );
        $messages = array(
            'name.required'=>'Ovo polje je obavezno!',
            'numEpisode.required' => 'Ovo polje je obavezno!',
            'numEpisode.integer' => 'Ovo polje mora biti pozitivan ceo broj!',
            'numEpisode.min' => 'Ovo polje mora biti pozitivan ceo broj!'


        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ((!(ctype_digit($request->duration)) || (ctype_digit($request->duration) && ($request->duration<0))) && $request->duration!=null){
            return redirect()->back()
                ->withErrors(['duration'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput();
        }
        $content = Content::find($episode->content_id);
        if ($request->name != null) {
            $content->name = $request->name;
        }
        if ($request->trailer != null) {
            $content->trailer = $request->trailer;
        }
        if ($request->description != null) {
            $content->description = $request->description;
        }
        if ($request->duration != null) {
            $episode->length = intval($request->duration);
        }
        if ($request->releaseDate!=null) {
            $content->release_date = $request->releaseDate;
        }
        if ($request->numEpisode!=null) {
            $episode->episode_number=$request->numEpisode;
        }
        $episode->update();
        $content->update();
        return redirect()->route('showepisode', ['episode' => $episode->content_id]);
    }



    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija uklanja sezonu iz baze zajedno sa njenim slikama
     *
     * @param integer $id
     * @return Redirect
     */
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

        return redirect()->route('home');
    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja brise sezonu za potrebe serije
     *
     * @param integer $id
     * @return Void
     */
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


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja brise seriju iz baze zajedno sa svim njenim slikama
     *
     * @param integer $id
     * @return Redirect
     */
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


        return redirect()->route('home');
    }



    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja brise slike proslijedjene kao parametar
     *
     * @param Picture $pictures
     * @return View
     */
    public static function deletePictureFiles($pictures){

        foreach($pictures as $picture){
            File::delete('img/img/content/'.$picture->path);
        }
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje prikaz trenutnog stanja sezone koju administrator želi da menja.
     * @param Season $season
     * @return Response
     */
    public function editSeason(Season $season) {
        $content = Content::find($season->content_id);
        $picturePaths = Picture::notMainPictures($season->content_id);
        $avatarPath = Picture::mainPicture($season->content_id);
        return response()->view('content.editSeason',compact('avatarPath', 'season','picturePaths','content'));
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje ažuran promenu stanja sezone.
     *
     * @param Request $request
     * @param Season $season
     * @return Response
     */
    public function changeSeasonData(Request $request, Season $season) {
        $rules=array(
            'name' => 'required',
            'numSeason' => 'required|integer|min:1'
        );
        $messages = array(
            'name.required'=>'Ovo polje je obavezno!',
            'numSeason.required' => 'Ovo polje je obavezno!',
            'numSeason.integer'=>'Ovo polje mora biti pozitivan ceo broj!',
            'numSeason.min' =>'Ovo polje mora biti pozitivan ceo broj!'

        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ((!(ctype_digit($request->episodes)) || (ctype_digit($request->episodes) && ($request->episodes<0))) && $request->episodes!=null){
            return redirect()->back()
                ->withErrors(['episodes'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput();
        }
        $content = Content::find($season->content_id);
        if ($request->name!=null) {
            $content->name = $request->name;
        }
        if ($request->description!=null) {
            $content->description = $request->description;
        }
        if ($request->trailer!=null) {
            $content->trailer = $request->trailer;
        }
        if ($request->releaseDate!=null) {
            $content->release_date = $request->releaseDate;
        }
        if ($request->episodes!=null) {
            $season->number_of_episodes = $request->episodes;
        }
        if ($request->numSeason!=null) {
            $season->season_number = $request->numSeason;
        }
        $content->update();
        $season->update();
        return redirect()->route('season',['id'=>$season->content_id]);
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje ažuran prikaz trenutnog stanja serije koju administrator želi da menja.
     *
     * @param Request $request
     * @param Tvshow $tvshow
     * @return Response
     */
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
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje izmenu žanrova serije.
     *
     * @param Request $request
     * @param Tvshow
     * @return Redirect
     */
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
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje dodavanje glumca seriji.
     *
     * @param Request $request
     * @param Episode $episode
     * @return Redirect
     */
    public function addEditActor(Request $request, Tvshow $tvshow) {
        $this->validate(request(), [
            'actor' => 'required|max:30'
        ]);
        $this->addActor($request, $tvshow->content_id);
        return redirect()->back();
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje dodavanje režisera seriji.
     *
     * @param Request $request
     * @param Tvshow $tvshow
     * @return Redirect
     */
    public function addEditDirector(Request $request, Tvshow $tvshow) {
        $this->validate(request(), [
            'director' => 'required|max:30'
        ]);
        $this->addDirector($request, $tvshow->content_id);
        return redirect()->back();
    }
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje brisanje glumaca dodeljenih seriji.
     *
     * @param Request $request
     * @param Tvshow $tvshow
     * @return Redirect
     */
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
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje brisanje režisera dodeljenih seriji.
     *
     * @param Request $request
     * @param Tvshow $tvshow
     * @return Redirect
     */
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
    /**
     * Autor: Simović Aleksa 0018/2015
     * Funkcija koja omogućuje promenu stanja serije.
     *
     * @param Request $request
     * @param Tvshow $tvshow
     * @return Redirect
     */
    public function changeTvshowData(Request $request, Tvshow $tvshow) {
        $rules=array(
            'name' => 'required'

        );
        $messages = array(
            'name.required'=>'Ovo polje je obavezno!'

        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ((!(ctype_digit($request->episodes)) || (ctype_digit($request->episodes) && ($request->episodes<0))) && $request->episodes!=null){
            return redirect()->back()
                ->withErrors(['episodes'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput();
        }
        if ((!(ctype_digit($request->duration)) || (ctype_digit($request->duration) && ($request->duration<0))) && $request->duration!=null){
            return redirect()->back()
                ->withErrors(['duration'=>"Ovo polje mora biti pozitivan ceo broj!"])
                ->withInput();
        }
        $content = Content::find($tvshow->content_id);
        if ($request->name!=null) {
            $content->name = $request->name;
        }
        if ($request->description!=null) {
            $content->description = $request->description;
        }
        if ($request->trailer!=null) {
            $content->trailer = $request->trailer;
        }
        if ($request->releaseDate!=null) {
            $content->release_date = $request->releaseDate;
        }
        if ($request->country!=null) {
            $tvshow->country = $request->country;
        }
        if ($request->language!=null) {
            $tvshow->language = $request->language;
        }
        if ($request->duration!=null) {
            $tvshow->length = $request->duration;
        }
        if ($request->endDate!=null) {
            $tvshow->end_date = $request->endDate;
        }
        if ($request->episodes!=null) {
            $tvshow->number_of_episodes=$request->episodes;
        }
        $content->save();
        $tvshow->save();

        return redirect()->route('showseries',['content->id'=>$tvshow->content_id]);
    }



    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja vraca formu za dodavanje trejlera za sezonu/seriju
     *
     * @param integer $id
     * @return View
     */

    public function addTrailer($id){

        $content = Content::find($id);

        return view('content.addtrailer',compact('content'));
        
    }



    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja azurira trejler za sezonu/seriju
     *
     * @param Request $request
     * @return Redirect
     */

    public function addTrailerPost(Request $request){

        $rules = array(
            'trailer' => 'required'
        );



        $messages = array(
            'trailer.required' => 'Niste uneli link do trejlera!',
        );



        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $trailer = explode('=', $request->trailer);

        $content = Content::find($request->id);

        $content->trailer = $trailer[1];

        $content->save();

        $id = $request->id;

        $season = Season::find($id);
        if($season!=null)
            return redirect()->route('season',compact('id'));
        else
            return redirect()->route('showseries',compact('id'));
    }

    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja prikazuje formu za dodavanje slika za epizodu/sezonu/seriju
     *
     * @param integer $id
     * @return View
     */

    public function addPicturesContent($id){

        $content = Content::find($id);

        return view('content.addpictures',compact('content'));

    }
    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja dodaje slike za epizodu/sezonu/seriju
     *
     * @param Request $request
     * @return Redirect
     */

    public function addPicturesContentPost(Request $request){

        $content = Content::find($request->id);
        $id = $request->id;


        //ako nije dodata nijedna slika vracamo se nazad
        if(empty($request->pictures)){
            return redirect()->route('redirectback',compact('id'));
        }


        foreach ($request->file('pictures') as $file) {
            $content->number_of_pictures++;
            $picture = new Picture();
            $picture->path = 'dummy';
            $picture->content_id = $content->id;
            $picture->main_picture = false;
            $picture->save();
            $filename = $content->id . '-' . $picture->id . '.jpg';
            $file = $file->storeAs('img/content', $filename);
            $picture->path = $filename;
            $picture->update();
        }

        $content->update();

        $episode = Episode::find($request->id);

        $season = Season::find($request->id);



        return redirect()->route('redirectback',compact('id'));
    }


    /**
     * Autor: Filip Đukić 0006/2015
     * Funkcija koja dodaje redirektuje na seriju/sezonu/epizodu
     *
     * @param integer $id
     * @return Redirect
     */
    public function redirectBackContent($id){
        $episode = Episode::find($id);

        $season = Season::find($id);



        if($episode!=null){//epizoda
            return redirect()->route('showepisode',compact('id'));
        }else if($season!=null){//sezona
            return redirect()->route('season',compact('id'));
        }else{//serija
            return redirect()->route('showseries',compact('id'));
        }
    }
}
