@extends('layouts.master')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>Naziv serije</h1>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="blog-title">
                    @include('rating.rate')
                </div>

            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>



        <div class="row" style="font-size: 20px">

            <div class="col-md-5">
                <!--Glavna slika	-->
                <center>
                    @foreach($content->pictures as $picture)
                        @if($picture->main_picture==true)
                    <img src="{{ $picture->path }}" style="width:100%;height:auto">
                        @endif
                        @endforeach
                </center>
                <br>
                <!--Glavna slika serije-->
                <div class="col-md-12">
                    <b>Glumci: </b>
                    @foreach($series->actings as $acting)
                        $actor = Category::find($acting->actor_id);
                        {{$actor->name}},
                        @endforeach
                </div>
            </div>
            <div class="col-md-2">
                <table style="border-collapse: separate;border-spacing:25px">
                    <tr>
                        <td>
                            <b> TV Serija: </b>
                            @if($content->release_date!=null)
                            {{$content->release_date}}
                                @endif
                            -
                            @if ($series->end_date!=null)
                            {{$series->end_date}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Žanr: </b>
                            @foreach($series->type_ofs as $typeof)
                                $genre = Category::find($typeof->genre_id);
                                {{$genre->name}},
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
                        <td style="width:30%"><a href="/season/{{$contents[i]->id}}">{{$contents[i]->name}}</a></td>
                        <td style="padding-top:16px">
                            @if(Auth::check())
                            <div class="progress">
                                <div class="progress-bar" style="width:{{$seasons[i]->watchingPercentage/$seasons[i]->number_of_episodes}}%">{{$seasons[i]->watchingPercentage/$seasons[i]->number_of_episodes}}%</div>
                            </div>
                                @else
                                <div class="progress">
                                    <div class="progress-bar" style="width:0%">0%</div>
                                </div>
                            @endif
                        </td>
                        <td style="width:15%;padding-left:5px">
                            @if(Auth::check())
                           {{ $seasons[i]->watchedPercentage}}/{{$seasons[i]->number_of_episodes}}
                                @else
                            0/{{$seasons[i]->number_of_episodes}}
                            @endif
                        </td>
                    </tr>
                        @endfor
                </table>
                @if (Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <form method="post" action="/addSeason/{{$content->id}}">
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
                </center>
                <!--Opis-->
                {{$content->description}}

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
                </center>

            </div>
        </div>
        <br>
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
                    <a href="{{ $picture->path }}" data-lightbox="movie">
                        <img src="{{ $picture->path }}">
                    </a>
                  @endforeach
                </center>
                @if (Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <a href="#">
                        <input type="submit" value="Dodaj sliku" class="btn btn-transparent">
                    </a>
                </center>
                    @endif
            </div>
        </div>



    </div>
    <br>
    <br>
@endsection