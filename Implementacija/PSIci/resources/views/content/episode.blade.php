@extends('layouts.master')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>{{$episode->seriesName()}}-{{$episode->seasonName()}}-{{$content->name}}</h1>
                </div>

            </div>
            <div class="col-lg-8">
                <!--
                <div class="blog-title">
                   include('rating.rate') ----||DODATI @ ispred
                </div>
                -->

            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>



        <div class="row" style="font-size: 15px">

            <div class="col-md-4">
                <!--Glavna slika	-->
                <center>

                    @foreach($content->pictures as $picture)
                        @if($picture->main_picture==true)
                            <img src="{{ asset('img/'.$picture->path) }}" style="width:100%;height:auto">
                        @else
                            <img src="{{ asset('img/avatar.png') }}" style="width:100%;height:auto">
                            @endif
                    @endforeach

                    <!--treba da ide path do glavne slike -->


                    @if(Auth::check() && Auth::user()->is_admin==true)
                        <a href="#">
                            <input type="submit" value="Izmeni informacije" class="btn btn-transparent">
                        </a>
                    @endif
                    @if(Auth::check() && Auth::user()->is_admin==false)
                        <a href="{{route('updatewatched',['id'=>$episode->content_id])}}">
                            <input type="submit" value="Označi kao odgledano" class="btn btn-transparent">
                        </a>
                    @endif

                </center>
                <br>

            </div>
            <div class="col-md-4">
                <h4>Opis: </h4>
                <p style="wisth:100%;word-wrap: break-word;"">
                    {{$content->description}}
                </p>
            </div>


            <div class="col-md-4" style="font-weight: bold">
                <center>
                    <h3>Slike</h3>
                </center>
                <center>

                    @foreach($content->pictures as $picture)
                        <div class="col-md-3" style="margin-bottom:10px;">
                            <a href="{{ asset('img/'.$picture->path) }}" data-lightbox="movie">
                                <img src="{{ asset('img/'.$picture->path) }}" style="max-width:95%;height:auto;">
                            </a>
                        </div>

                    @endforeach
                </center>
                @if(Auth::check() && Auth::user()->is_admin==true)
                    <center>
                        <a href="#">
                            <input type="submit" value="Dodaj sliku" class="btn btn-transparent">
                        </a>
                    </center>
                @endif
            </div>

        </div>



        <br>
        <div class="row">
            <div id="comments" class="comments-section col-md-8">
                <h4>{{count($comments)}} komentara</h4>
                <ol class="comment-list">
                    <li id="comment-1">

                        <!-- Svaki komentar(foreach) ide u ovaj comment wrap-->
                        <!--Znaci ovdje ce ici foreach-->
                        @foreach($comments as $comment)

                            @if($comment->contains_spoiler == 0)
                                <div class="comment-wrap">
                                    <div class="author-avatar pull-left">
                                        <img src="img/avatar.png" alt="">
                                    </div>
                                    <div class="author-comment">
                                        <cite class="pull-left"><a href="#">{{ $comment->user_id}}</a></cite>
                                        <a href="" class="replay pull-right">Replay</a>
                                        <div style="clear:both"></div>
                                        <div class="comment-meta">
                                            <i class="fa fa-calendar"></i> {{$comment->created_at->format('m/d/Y')}}
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p style="word-wrap: break-word;">
                                            KOMENTAR KOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTARKOMENTAR
                                        </p>
                                    </div>
                                </div>
                                <br>
                        @else
                                <div class="comment-wrap">
                                    <div class="author-avatar pull-left">
                                        <!--Slika korisnika-->
                                        <img src="img/avatar.png" alt="">
                                    </div>
                                    <div class="author-comment">
                                        <!--Ime korisnika-->
                                        <cite class="pull-left">
                                            <!-- DODATI LINK KA PROFILU KORISNIKA -->
                                            <a href="#">{{ $comment->user_id}}</a>
                                        </cite>
                                        @if(Auth::check() && Auth::user()->is_admin==true)

                                            <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a>
                                            <br>
                                            <a href="{{ route('updatespoilerremove',['id'=>$comment->id]) }}" class="replay pull-right">Ne sadrzi spojlere</a>
                                            <br>
                                            <a href="#{{$comment->id}}" data-toggle="collapse" class="replay pull-right">Prikazi komentar</a>
                                        @endif
                                    <!-- PRIAKZI MU KOMENTAR AKO JE ON NJEGOV KREATOR-->
                                        @if(Auth::check() && Auth::user()->is_admin==false && Auth::user()->username==$comment->user_id)

                                            <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a>
                                            <br>

                                            <a href="#{{$comment->id}}" data-toggle="collapse" class="replay pull-right">Spoiler! Prikazi komentar</a>
                                        @endif

                                        <div style="clear:both"></div>
                                        <div class="comment-meta">
                                            <!--Datum komentara-->
                                            <i class="fa fa-calendar"></i> {{$comment->created_at->format('m/d/Y')}}
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p id="{{$comment->id}}" class="collapse">
                                            {{$comment->description}}
                                        </p>
                                    </div>
                                </div>
                                <br>




                        @endif
                        @endforeach

                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <center>
                        {{ $comments->links() }}
                    </center>
                </div>
            </div>
            <!-- Forma za postavljanje komentara-->
            <div class="col-md-8">
                <h3>Ostavi komentar</h3>
                <form id="comment-form" method="post" action="{{route('addcomment')}}">
                    <input type="hidden" name="episode_id" value={{$episode->content_id}}  lenght="30"/><!--Id epizode-->
                    @csrf
                    <!-- End .form-group -->
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Komentar *" id="comment" name="comment" rows="5" cols="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="spoiler" value="1"> &nbsp; Sadrzi spojler
                    </div>
                    <!-- End .form-group -->
                    <div class="form-group">
                        <input type="submit" id="post-comment" value="Postavi komentar" class="btn btn-transparent">
                    </div>
                    <!-- End .form-group -->
                </form>
            </div>
        </div>





        <br>
        <br>
    </div>


@endsection