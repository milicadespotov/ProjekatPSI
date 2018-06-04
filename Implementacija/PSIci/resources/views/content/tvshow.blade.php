
<?php use Carbon\Carbon;
use App\Category;
?>

@extends('layouts.master')

@section('content')



    <div class="container-fluid">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>{{$content->name}}</h1>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                        <a href="#myModal3" data-toggle="modal">
                            <input type="submit" value="Obrisi seriju" class="btn btn-transparent">
                        </a>
                    @endif
                </div>

            </div>
            <div class="col-lg-4">
                <div class="blog-title">
                    @include('rating.rate')
                </div>
            </div>
            <div clas="col-lg-4">
                &nbsp;
            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>

        @if(Auth::check())

            <div class="modal" id="myModal3" style="margin-top:15%;color:black;">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color:#2B2C30;color:white">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-size:20px">Brisanje serije
                                <button style="margin-bottom:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></h5>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da uklonite ovu seriju?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="{{ route('seriesremove',['id'=>$content->id]) }}">
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

        <div class="row" style="font-size: 20px">

            <div class="col-md-5">
                <!--Glavna slika	-->
                <center>
                    @foreach($content->pictures as $picture)
                        @if($picture->main_picture==true)

                            <img src="{{ asset('img/'.$picture->path) }}" style="width:100%;height:auto">

                    <img src="{{ asset('img/img/content/'.$picture->path) }}" style="width:100%;height:auto">

                        @endif
                        @endforeach
                </center>
                <br>
                <!--Glavna slika serije-->
                <div class="col-md-12">
                    <b>Režiseri: </b><br>
                    @foreach($series->directors() as $director)
                        {{$director->name}}<br>
                        @endforeach
                </div>
                <div class="col-md-12">
                    <b>Glumci: </b><br>
                    @foreach($series->actors() as $actor)
                        {{$actor->name}}<br>
                    @endforeach
                </div>
            </div>
            <div class="col-md-2">
                <table style="border-collapse: separate;border-spacing:25px">
                    <tr>
                        <td>
                            <b> TV Serija: </b>
                            @if($content->release_date!=null)
                                {{Carbon::createFromFormat('Y-m-d H:i:s', $content->release_date)->year}}
                            @endif
                            -
                            @if ($series->end_date!=null)
                                {{Carbon::createFromFormat('Y-m-d H:i:s', $series->end_date)->year}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Žanr: </b><br>
                            @foreach($genres as $genre)
                                {{$genre->name}}<br>
                                @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Zemlja: </b>
                            @if ($series->country!=null)
                                {{$series->country}}
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Trajanje: </b>
                            @if($series->length!=null)
                                {{$series->length}}
                                @endif
                            min
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Jezik: </b>
                            @if($series->language!=null)
                                {{$series->language}}
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if (Auth::check() && Auth::user()->is_admin==true)
                            <a href="#">
                                <input type="submit" value="Izmeni podatke" class="btn btn-transparent">
                            </a>
                                @else
                            &nbsp;
                                @endif
                        </td>
                    </tr>
                </table>
            </div>


            <div class="col-md-5" style="font-weight: bold">
                <!--Sezone-->
                <table class="table-dark  " style="width:100%;text-align: center">
                    <th colspan="3" style="text-align: center">
                        <h3>Sezone</h3>
                    </th>

                    @for($i=0;$i<count($seasons);$i++)
                        <tr>
                            <td style="width:30%"><a href="/season/{{$contents[$i]->id}}">{{$contents[$i]->name}}</a></td>
                            <td style="padding-top:16px">
                                @if(Auth::check())
                                    <div class="progress">
                                        <div class="progress-bar" style="width:{{$seasons[$i]->watchedPercentage()/$seasons[$i]->number_of_episodes*100}}%"><font style="color:#2B2C30">{{$seasons[$i]->watchedPercentage()/$seasons[$i]->number_of_episodes*100}}%</font></div>
                                    </div>
                                @else
                                    <div class="progress">
                                        <div class="progress-bar" style="width:0%">0%</div>
                                    </div>
                                @endif
                            </td>
                            <td style="width:15%;padding-left:5px">
                                @if(Auth::check())
                                    {{ $seasons[$i]->watchedPercentage()}}/{{$seasons[$i]->number_of_episodes}}
                                @else
                                    0/{{$seasons[$i]->number_of_episodes}}
                                @endif
                            </td>
                        </tr>
                    @endfor
                </table>
                @if (Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <form method="post" action="{{route('addSeason',['id'=>$content->id])}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <input type="submit" value="Dodaj sezonu" class="btn btn-transparent">
                    </form>
                </center>
                    @endif
            </div>



        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <center>
                    <h2>Opis:</h2>
                    <br>
                    <br>
                </center>
                <!--Opis-->
                <p style="width:100%;word-wrap: break-word;">
                    {{$content->description}}
                </p>

            </div>
            <div class="col-md-6">
                <!--Trejler-->
                <center>
                    <h2>Trejler</h2>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                        <a href="#">
                            <input type="submit" value="Dodaj trejler" class="btn btn-transparent">
                        </a>
                    @endif
                    <br>
                    <br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$content->trailer}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                </center>

            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h2>Slike</h2>

                    @if (Auth::check() && Auth::user()->is_admin==true)
                        <center>
                            <a href="#">
                                <input type="submit" value="Dodaj sliku" class="btn btn-transparent">
                            </a>
                        </center>
                    @endif
                </center>
                <br>
                <br>
            </div>
            <!--Galerija-->
            <div class="col-md-12">


                    @foreach($content->pictures as $picture)
                        <div class="col-md-3" style="margin-bottom:10px;">
                    <a href="{{ asset('img/img/content/'.$picture->path) }}" data-lightbox="movie">
                        <img src="{{ asset('img /'.$picture->path) }}" style="max-width:95%;height:auto;margin-top:15px">
                    </a>
                        </div>
                  @endforeach


            </div>
        </div>



    </div>
    <br>
    <br>
@endsection