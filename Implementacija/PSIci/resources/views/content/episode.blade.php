@extends('layouts.master')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>{{$content->name}}</h1>
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



        <div class="row" style="font-size: 15px">

            <div class="col-md-4">
                <!--Glavna slika	-->
                <center>
                    <img src="{{$path}}" style="width:100%;height:auto">
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
                <p>
                    {{$content->description}}
                </p>
            </div>


            <div class="col-md-4" style="font-weight: bold">
                <center>
                    <h3>Slike</h3>
                </center>
                <center>
                    @foreach($content->pictures as $picture)
                    <a href="{{$picture->path}}" data-lightbox="movie">
                        <img src="{{$picture->path}}">
                    </a>
                    <br>
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
                <h4>Broj komentara</h4>
                <ol class="comment-list">
                    <li id="comment-1">

                        <!-- Svaki komentar(foreach) ide u ovaj comment wrap-->
                        <!--Znaci ovdje ce ici foreach-->
                        @foreach($comments as $comment)
                        <div class="comment-wrap">
                            <div class="author-avatar pull-left">
                                <!--Slika korisnika-->
                                <img src="img/blog/user.jpg" alt="">
                            </div>
                            <div class="author-comment">
                                <!--Ime korisnika-->
                                <cite class="pull-left">
                                    <!-- DODATI LINK KA PROFILU KORISNIKA -->
                                    <a href="#">{{ $comment->user_id}}</a>
                                </cite>
                                @if(Auth::check() && Auth::user()->is_admin==true)

                                    <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a><br>
                                    <a href="{{ route('updatespoiler',['id'=>$comment->id]) }}" class="replay pull-right">Sadrzi spojlere</a>
                                @endif
                                <!-- PRIAKZI MU KOMENTAR AKO JE ON NJEGOV KREATOR-->
                                @if(Auth::check() && Auth::user()->is_admin==false && Auth::user()->username==$comment->user_id)

                                    <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a>
                                @endif

                                <div style="clear:both"></div>
                                <div class="comment-meta">
                                    <!--Datum komentara-->
                                    <i class="fa fa-calendar"></i> {{date('d-m-Y',$comment->created_at)}}
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    {{$comment->description}}
                                </p>
                            </div>
                        </div>

                        <br>

                        @endforeach

                    </li>
                </ol>
            </div>
            <!-- Forma za postavljanje komentara-->
            <div class="col-md-8">
                <h3>Ostavi komentar</h3>
                <form id="comment-form" method="post" action="addcomment">
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