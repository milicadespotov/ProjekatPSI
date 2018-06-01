@extends('layouts.master')


@section('content')

    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-6">
                    <img src="{{$user->picture_path}}" style="width:100%">
                    <h4>Status: Korisnik</h4>
                    <p>
                        <a href="{{route('infoupdate')}}">
                            <input type="submit" value="Izmeni informacije" class="btn btn-transparent">
                        </a>
                    </p>
                    <p>
                        <a href="#">
                            <input type="submit" value="Odgledano" class="btn btn-transparent">
                        </a>
                    </p>
                </div>
                <div class="col-md-6">
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <h4>Email adresa: {{$user->email}}</h4>
                    <h4>Datum rodjenja:  @if (!is_null($user->birth_date)) echo Carbon::parse($user->birth_date)->format('d/m/Y'); @endif </h4>
                    <h4>Pol: {{$user->gender}}</h4>
                    <h4>Clan od: {{ \Carbon\Carbon::parse($user->registration_date)->format('d/m/Y')}}</h4>
                </div>
            </div>
            <div class="col-md-8 ">
                <center>
                    <h3>Poslednje ocenjene serije</h3>
                </center>
                <br>
                <div>
                    <center><!--Sve ocijenjene serije-->
                        @foreach($lastRated as $show)
                             <a href="{{route('showseries',['id'=>$show->content_id])}}" >
                                 <img src="{{$show->mainPicture}}" style="width:300px;height:auto;">
                             </a>
                        @endforeach
                    </center>
                </div>
                <br>
                <br>
                <br>
                <br>
                <center>
                    <h3>Poslednje odgledane epizode</h3>
                </center>
                <br>
                <div>
                    <center><!--Sve odgledane epizode-->
                        @foreach($lastWatched as $episode)
                            <a href="{{route('showepisode',['id'=>$episode->content_id])}}" >
                                <img src="{{$episode->mainPicture}}" style="width:300px;height:auto;">
                            </a>
                        @endforeach
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

@endsection