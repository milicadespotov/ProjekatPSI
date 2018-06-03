@extends('layouts.master')


@section('content')

    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-6"><!--SREDITI DA SE UBACI DEAFULT PROFILNA SLIKA!!!!-->
                    <img src=<?php if(is_null($user->picture_path)){ echo 'img/avatar.png' ;} else {$path = 'img/img/users/'.$user->picture_path; echo $path; } ?> style="width:100%">
                    <h4>&nbsp;</h4>
                    <h4>
                        @if(Auth::check() && Auth::user()->is_admin==false)
                            Status: Korisnik
                        @endif
                            @if(Auth::check() && Auth::user()->is_admin==true)
                               Status: Admin
                            @endif

                    </h4>
                    <p>     @if(Auth::check() && Auth::user()->is_admin==false)
                        <a href="{{route('infoupdate')}}">
                            <input type="submit" value="Izmeni informacije" class="btn btn-transparent">
                        </a>
                           @endif
                            @if(Auth::check() && Auth::user()->is_admin==true)
                            <a href="{{route('accountManager')}}">
                                <input type="submit" value="Upravljanje nalozima" class="btn btn-transparent">
                            </a>
                            @endif
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
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <h4>Email adresa: {{$user->email}}</h4>
                    <h4>Datum rodjenja:  <?php if(!is_null($user->birth_date)) echo \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y'); ?> </h4>
                    <h4>Pol: {{$user->gender}}</h4>
                    <h4>Clan od: {{ \Carbon\Carbon::parse($user->registration_date)->format('d/m/Y')}}</h4>
                </div>
            </div>
            <div class="col-md-8 ">
                <center>
                    <h3>
                        @if(Auth::check() && Auth::user()->is_admin==true)
                            Poslednje modifikovane serije
                            @endif
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

                             <a href="{{route('showseries',['id'=>$lastRated[$i]->content_id])}}" >
                                 <img src="{{ asset('img/'.$picturesLR[$i]->path) }}" style="width: 300px;height:auto;margin-left:10px;margin-bottom:5px">
                             </a>
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

                        @if(Auth::check() && Auth::user()->is_admin==true)
                            Poslednje dodate serije
                        @endif
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



                            <a href="{{route('showepisode',['id'=>$lastWatched[$i]->content_id])}}" >
                                <img src="{{ asset('img/'.$picturesLW[$i]->path) }}" style="width:300px;height:auto;margin-left:10px;margin-bottom:5px">

                            </a>
                        @endfor
                        @endif
                        @endif


                        @if(Auth::check() && Auth::user()->is_admin==true)



                            @if(count($lastAdded)==0)
                                <h4>Nema dodatih serija!</h4>
                            @else
                                @for($i=0;$i<sizeof($lastAdded);$i++)



                                    <a href="{{route('showseries',['id'=>$lastAdded[$i]->content_id])}}" >
                                        <img src="{{ asset('img/'.$picturesLA[$i]->path) }}" style="width:300px;height:auto;margin-left:10px;margin-bottom:5px">

                                    </a>
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