@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;{{$season->seriesName()}}-{{$season->season_number}}.{{$content->name}}



                    </h1>
                    @if(Auth::check() && Auth::user()->is_admin==true)

                        <center>


                            <form method="get" action="{{ route('addepisode',['id'=>$content->id]) }}">
                                <a href="#myModal2" data-toggle="modal">
                                    <input type="submit" value="Obrisi sezonu" class="btn btn-transparent">
                                </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @csrf
                                <input type="submit" value="Dodaj epizodu" class="btn btn-transparent">
                            </form>
                        </center>
                    @endif
                </div>

            </div>
            <div class="col-lg-4">
                <div class="blog-title">
                    @include('rating.rate')
                </div>

            </div>
            <div class="col-lg-4">

                &nbsp;
            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>



        <div class="row">

            <div class="col-md-7">
                @for($i=0;$i<count($contents);$i++)
                <div class="row">
                    <div class="col-md-12" style="margin-bottom:30px">
                        <div class="col-md-4">
                            @if($episodes[$i]->mainPicture()->first()!=null)
                                <img src="{{asset('img/img/content/'.$episodes[$i]->mainPicture()->first()->path)}}" style="width:100%">
                            @else
                                <img src="{{asset('img/default_content.png')}}" style="width:100%;height:auto;">
                            @endif

                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('showepisode',['id'=>$contents[$i]->id]) }}"><h4>{{$contents[$i]->name}}</h4></a>
                            <p style="width:100%;word-wrap: break-word;">
                                {{$contents[$i]->description}}
                            </p>

                        </div>

                    </div>

                </div>
                    @endfor
            </div>

            @if(Auth::check())

                <div class="modal" id="myModal2" style="margin-top:15%;color:black;">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color:#2B2C30;color:white">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-size:20px">Brisanje sezone
                                    <button style="margin-bottom:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></h5>
                            </div>
                            <div class="modal-body">
                                <p>Da li ste sigurni da želite da uklonite ovu sezonu?</p>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="{{ route('seasonremove',['id'=>$season->content_id]) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @csrf
                                    <input type="submit" class="btn btn-transparent" value="Potvrdi">
                                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Odustani</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-5">
                <!--Trejler-->
                <center>
                    <h2>Trejler</h2>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                    <a href="#">
                        <input type="submit" value="Dodaj trejler " class="btn btn-transparent">
                    </a>
                        @endif
                    <br>
                    <br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$content->trailer}}" style="width:100%;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                </center>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <center>
                    @if($content->pictures !=null )
                    <h2>Slike</h2>
                    @endif
                    <br>
                </center>
            </div>
            <!--Galerija-->
            <div class="col-md-12">
                <center>
                @foreach($content->pictures as $picture)
                    <div class="col-md-3" style="margin-bottom:10px;">
                        <a href="{{ asset('img/img/content/'.$picture->path) }}" data-lightbox="movie">
                            <img src="{{ asset('img/img/content/'.$picture->path) }}" style="max-width:95%;height:auto;">
                        </a>
                    </div>
                 @endforeach
                </center>


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