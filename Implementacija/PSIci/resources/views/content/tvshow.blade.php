
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
        <td>

            <div class = "info-value" style = "padding: 5px; padding-left: 10px ; font-family: 'Lucida Sans Unicode' !important">|
                @foreach($genres as $genre)
                    {{$genre->name}} |
                @endforeach
            </div>
        </td>
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
                <center><?php $flag=false; ?>
                    @foreach($content->pictures as $picture)
                        <?php if($picture->main_picture==true){ $flag=true;?>

                             <img src="{{ asset('img/img/content/'.$picture->path) }}" style="width:100%;height:auto">

                        <?php }?>
                        @endforeach
                        <?php if(!$flag) { ?>

                  <img src="{{ asset('img/default_content.png')}}" style="width:60%;height:auto">

                            <?php } ?>
                </center>
                <br>
                <!--Glavna slika serije-->
                <div class="col-md-12">
                    <div class = "info-name"> Režiseri: </div>
                    <div class = "info-value">
                    @foreach($series->directors() as $director)
                        {{$director->name}} |
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">

                    <div class ="info-name"> <div class = "info-name"> Glumci: </div> </div>
                    <div class ="info-value">
                    @foreach($series->actors() as $actor)
                        {{$actor->name}} |
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <table style="border-collapse: separate;border-spacing:25px">
                    <tr>
                        <td>
                            <div class = "info-name">TV Serija: &nbsp;  </div>
                            <div class = "info-value">
                            @if($content->release_date!=null)
                                {{Carbon::createFromFormat('Y-m-d H:i:s', $content->release_date)->year}}
                            @endif
                            -
                            @if ($series->end_date!=null)
                                {{Carbon::createFromFormat('Y-m-d H:i:s', $series->end_date)->year}}
                            @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class = "info-name"> Zemlja: </div>
                            <div class = "info-value">
                            @if ($series->country!=null)
                                {{$series->country}}
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class = "info-name">
                                Trajanje:
                            </div>
                            <div class = "info-value">
                            @if($series->length!=null)
                                {{$series->length}}
                                @endif
                            min
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class = "info-name"> Jezik: </div>
                            <div class = "info-value">
                            @if($series->language!=null)
                                {{$series->language}}
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if (Auth::check() && Auth::user()->is_admin==true)
                            <a href="{{route('editseries',['tvshow'=>$series->content_id])}}">
                                <input type="submit" value="Izmeni podatke" class="btn btn-transparent">
                            </a>

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
                            <td style="width:30%"><a href="{{route('season',['id'=>$contents[$i]->id])}}">{{$contents[$i]->name}}</a></td>
                            <td style="padding-top:16px">
                                @if(Auth::check())
                                    <div class="progress">
                                        @if ($seasons[$i]->number_of_episodes == 0 || $seasons[$i]->number_of_episodes==null)
                                            <div class="progress-bar" style="width:0%"><font style="color:#2B2C30">0%</font></div>
                                        @else
                                        <div class="progress-bar" style="width:{{$seasons[$i]->watchedPercentage()/$seasons[$i]->number_of_episodes*100}}%"><font style="color:#2B2C30"></font></div>
                                    @endif
                                    </div>
                                @else
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped"  style="width:0%; background-color: #8A2BE2" >0%</div>
                                    </div>
                                @endif
                            </td>
                            <td style="width:15%;padding-left:5px">
                                @if(Auth::check())
                                    {{ $seasons[$i]->watchedPercentage()}}/@if ($seasons[$i]->number_of_episodes ==0 || $seasons[$i]->number_of_episodes==null)0
                                    @else
                                        {{$seasons[$i]->number_of_episodes}}
                                    @endif
                                @else
                                    @if ($seasons[$i]->number_of_episodes ==0 || $seasons[$i]->number_of_episodes==null)0/0
                                    @else
                                    0/{{$seasons[$i]->number_of_episodes}}
                                        @endif
                                @endif
                            </td>
                        </tr>
                    @endfor
                </table>
                @if (Auth::check() && Auth::user()->is_admin==true)
                <center>
                    <form method="get" action="{{route('addSeason',['id'=>$content->id])}}">
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
                <p style="width:100%;word-wrap: break-word;font-size:16px;">
                    {{$content->description}}
                </p>

            </div>
            <div class="col-md-6">
                <!--Trejler-->
                <center>

                        <h2>Trejler</h2>

                    @if(Auth::check() && Auth::user()->is_admin==true)
                        <a href="{{route('addtrailer',['id'=>$content->id])}}">
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
                    @if($content->pictures != null)
                    <h2>Slike</h2>
                    @endif
                    @if (Auth::check() && Auth::user()->is_admin==true)
                        <center>
                            <a href="{{route('addpictures',['id'=>$content->id])}}">
                                <input type="submit" value="Dodaj sliku" class="btn btn-transparent">
                            </a>
                        </center>
                    @endif
                </center>
                <br>
                <br>
            </div>
            <!--Galerija-->
            <div>
                <?php $i=0; ?>
                @foreach($content->pictures as $picPath)
                    <?php
                    if ($i%4==0) echo '<div class="row">';
                    ?>
                    <div class="col-lg-3">
                        <a href="{{ asset('img/img/content/'.$picPath->path) }}" data-lightbox="movie">
                            <center><img src="{{ asset('img/img/content/'.$picPath->path) }}" style="max-width:100%;height:auto;margin-bottom:10px;align:center">
                            </center>
                        </a>
                    </div>
                    <?php
                    $i=$i+1;
                    if ($i%4==0) echo '</div>';
                    ?>
                @endforeach
            </div>
        </div>



    </div>
    <br>
    <br>
@endsection