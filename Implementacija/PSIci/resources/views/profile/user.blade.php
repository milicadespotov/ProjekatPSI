@extends('layouts.master')


@section('content')

    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-6"><!--SREDITI DA SE UBACI DEAFULT PROFILNA SLIKA!!!!--> <br>
                    <img   class = "img-fluid img-rounded" src=<?php if(is_null($user->picture_path)){ echo 'img/avatar.png' ;} else {$path = 'img/img/users/'.$user->picture_path; echo $path; } ?> style="width:100%">
                    <div class = "info-name">
                        <i> Član WhySoSeries od</i>
                    </div>
                    <div class = "info-name">
                        <i> {{ \Carbon\Carbon::parse($user->registration_date)->format('d/m/Y')}} </i>
                    </div>

                    <h4>
                        @if(Auth::check() && Auth::user()->is_admin==false)
                            Status: Korisnik
                        @endif
                            @if(Auth::check() && Auth::user()->is_admin==true)
                                <div class = "info-name"> Status: </div> <div class = "info-value"> Admin </div>
                            @endif

                    </h4>
                    <p>
                        <a href="{{route('infoupdate')}}">
                            <input type="submit" value="Izmeni informacije" class="btn btn-transparent">
                        </a>

                    </p>
                    <p>
                        @if(Auth::check() && Auth::user()->is_admin==false)
                        <a href="{{route('watchedepisodes')}}">
                            <input type="submit" value="Odgledano" class="btn btn-transparent">
                        </a>
                        @endif
                            @if(Auth::check() && Auth::user()->is_admin==true)
                                <a href="{{route('addseries')}}">
                                    <input type="submit" value="Dodavanje novih serija" class="btn btn-transparent">
                                </a>
                            @endif
                    </p>
                </div>
                <div class="col-md-6">

                    <div class = "color">  <h2>{{$user->name.' '.$user->surname}}</h2> <br> <br> </div>
                    <div class = "info-name">
                        Email adresa:  &nbsp;
                    </div>
                    <div class = "info-value">
                        {{$user->email}}
                    </div>
                    <br>
                    <div class = "info-name">
                        Datum rodjenja: &nbsp;
                    </div>

                    <div class = "info-value">
                        <?php if(!is_null($user->birth_date)) echo \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y'); ?>
                    </div> <br>
                    <div class = "info-name">Pol:  &nbsp;    </div>
                    <div class = "info-value">
                    @if ($user->gender == 'f')
                        Ženski
                    @else
                        Muški
                    @endif
                    </div>

                    <br>



                </div>
            </div>
            <div class="col-md-7 ">
                <center>
                    <h3>

                        @if(Auth::check() && Auth::user()->is_admin==true)
                            Poslednje modifikovane serije
                            @endif
                        <br>
                        @if(Auth::check() && Auth::user()->is_admin==false)
                            Poslednje ocenjene serije
                        @endif
                    </h3>
                </center>
                <br>
                <div>
                    <center><!--Sve ocijenjene serije-->
                        @if(count($lastRated)==0)
                            <h4>Nemate ocenjenih/modifikovanih serija!</h4>
                        @else

                            @for($i=0;$i<sizeof($lastRated);$i++)
                                <div class = "col-md-4">
                             <a href="{{route('showseries',['id'=>$lastRated[$i]->content_id])}}" >
                                 <img src=<?php if(is_null($picturesLR[$i])){ echo 'img/default_content.png' ;} else {$path = 'img/img/content/'.$picturesLR[$i]->path; echo $path; } ?> style="width:100%;height:auto;margin-left:10px;margin-bottom:5px">
                             </a>
                                </div>
                            @endfor

                        @endif
                    </center>
                </div>
                <br>
                <br>

                <br>
                <br>
                <center>
                    <h3>
                        <br>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                            Poslednje dodate serije
                        @endif
                        <br>

                    @if(Auth::check() && Auth::user()->is_admin==false)
                            Poslednje odgledane epizode serije
                        @endif
                    </h3>
                </center>
                <br>
                <div>
                    <center><!--Sve odgledane epizode-->

                        @if(Auth::check() && Auth::user()->is_admin==false)

                        @if(count($lastWatched)==0)
                            <h4>Nemate odgledanih epizoda!</h4>
                        @else
                        @for($i=0;$i<sizeof($lastWatched);$i++)
                                    <div class = "col-md-4">
                            <a href="{{route('showepisode',['id'=>$lastWatched[$i]->content_id])}}" >
                                <img src=<?php if(is_null($picturesLW[$i])){ echo 'img/default_content.png' ;} else {$path = 'img/img/content/'.$picturesLW[$i]->path; echo $path; } ?> style="width:100%;height:auto;margin-left:10px;margin-bottom:5px">

                            </a>
                                    </div>
                        @endfor
                        @endif
                        @endif


                        @if(Auth::check() && Auth::user()->is_admin==true)



                            @if(count($lastAdded)==0)
                                <h4>Nema dodatih serija!</h4>
                            @else
                                @for($i=0;$i<sizeof($lastAdded);$i++)


                                    <div class = "col-md-4">
                                    <a href="{{route('showseries',['id'=>$lastAdded[$i]->content_id])}}" >
                                        <img src=<?php if(is_null($picturesLA[$i])){ echo 'img/default_content.png' ;} else {$path = 'img/img/content/'.$picturesLA[$i]->path; echo $path; } ?> style="width:100%;height:auto;margin-left:10px;margin-bottom:5px">

                                    </a>
                                    </div>
                                @endfor
                            @endif
                        @endif



                    </center>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

@endsection