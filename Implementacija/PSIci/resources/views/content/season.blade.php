@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1><a href="{{route('showseries',['content_id'=>$season->seriesId()])}}">{{$season->seriesName()}}</a> - {{$season->season_number}}. {{$content->name}}



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

                    @if ($isWatched == null)

                        <a href="{{route('update_watched_season',['id'=>$season->content_id])}}">
                            <img src = "{{asset('img/w.png')}}" style = "width: 20px; height: auto">
                            Označi kao odgledano
                        </a>

                    @else


                        <a href="{{route('update_unwatched_season',['id'=>$season->content_id])}}">
                            <img  class = "img-fluid" src = "{{asset('img/ww.png')}}" style = "width: 20px; height:auto">
                            <i> Odgledano </i>
                        </a>

                    @endif
                </div>

            </div>
            <div class="col-lg-4">
                    @if (Auth::check() && Auth::user()->is_admin==true)
                    <a href="{{route('editseason',['season'=>$content->id])}}">
                        <input type="submit" value="Izmeni podatke" class="btn btn-transparent">
                    </a>
                    @endif
                &nbsp;
            </div>
            <!-- End col-lg-12 -->
        </div>

        <br>
        <div class="row">
            <div class="col-md-4" >
                <?php $flag=false; ?>

                @foreach($content->pictures as $picture)
                    <?php if($picture->main_picture==true){ $flag=true; ?>
                    <table width="100%">
                        <tr>
                            <td width="15%">&nbsp;</td>
                            <td><img src="{{ asset('img/img/content/'.$picture->path) }}" style="width:95%;height:auto;"></td>
                        </tr>
                    </table>
                    <?php } ?>
                @endforeach

                <?php if(!$flag) { ?>
                    <table width="100%">
                        <tr>
                            <td width="15%">&nbsp;</td>
                            <td><img src="{{ asset('img/default_content.png') }}" style="width:95%;height:auto"></td>
                        </tr>
                    </table>
                <?php }?>

            </div>
            <div class="col-md-7" >
                <br>
                <h2>Opis</h2>
                <br>
                <p style="width:100%;word-wrap: break-word;font-size:16px;">
                    {{$content->description}}
                </p>
            </div>
        </div>
        <br>
        <br>



        <div class="row">

            <div class="col-md-7">
                <center><h2>Epizode</h2></center>
                <br>
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
                                {{substr($contents[$i]->description,0,300)}}...
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
                    <a href="{{route('addtrailer',['id'=>$season->content_id])}}">
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
                        @if(Auth::check() && Auth::user()->is_admin==true)
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
        <br>
        <br>



    </div>
    @endsection