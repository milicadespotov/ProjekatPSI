@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>{{$season->seriesName}}-{{$season->season_number}}.{{$content->name}} </h1>

                </div>

            </div>
            <div class="col-lg-4">
                @if(Auth::check() && Auth::user()->is_admin==true)
                    <center>
                        <form method="post" action="/addEpisode/{{$content->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @csrf
                            <input type="submit" value="Dodaj epizodu" class="btn btn-transparent">
                        </form>
                    </center>
                    @endif

            </div>
            <div class="col-lg-4">
                <div class="blog-title">
                    @include('rating.rate')
                </div>

            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>



        <div class="row">

            <div class="col-md-8">
                @for($i=0;$i<count($episodes);$i++)
                <div class="row">
                    <div class="col-md-12" style="margin-bottom:10px">
                        <div class="col-md-4">
                            @foreach($contents[i]->pictures as $picture)
                                @if ($picture->main_picture==true)
                                    <a href="/episode/{{$contents[i]->id}}"><img src="{{$picture->path}}" style="width:100%"></a>
                                @endif
                            @endforeach
                            @if (Auth::check() && Auth::user()->is_admin==true)
                            <center>
                                <a href="#">
                                    <input type="submit" value="Izmeni" class="btn btn-transparent">
                                </a>
                            </center>
                                @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{$contents[i]->name}}</h4>
                            {{$contents[i]->description}}
                        </div>



                    </div>



                </div>
                    @endfor
            </div>
            <div class="col-md-4">
                <!--Trejler-->
                <center>
                    <h2>Trejler</h2>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                    <a href="#">
                        <input type="submit" value="Dodaj trejler " class="btn btn-transparent">
                    </a>
                        @endif
                </center>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h2>Slike</h2>
                    <br>
                </center>
            </div>
            <!--Galerija-->
            <div class="col-md-12">
                <center>
                    @foreach($content->pictures as $picture)
                    <a href="{{$picture->path}}" data-lightbox="movie">
                        <img src="{{$picture->path}}">
                    </a>
                   @endforeach



                </center>
                @if(Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <a href="#">
                        <input type="submit" value="Dodaj sliku" class="btn btn-transparent">
                    </a>
                    @endif
                </center>
            </div>
        </div>
        <br>
        <br>



    </div>
    @endsection