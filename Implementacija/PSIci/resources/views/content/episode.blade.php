@extends('layouts.master')


@section('content')
    <div class="container-fluid">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-4 ">

                <div class="blog-title">
                    <h1>
                       <a href="{{route('showseries', ['content_id'=>$episode->seriesId()])}}" >{{$episode->seriesName()}}</a> - <a href="{{route('season', ['id'=>$episode->seasonId()])}}" >{{$episode->seasonName()}}</a> - {{$content->name}}

                    </h1>
                </div>

            </div>
            <br>
            <div class="col-lg-8">

                <div class="blog-title">
                   @include('rating.rate')
                    @if (Auth::check())
                        @if ($isWatched == null)

                            <a href="{{route('updatewatched',['id'=>$episode->content_id])}}">
                                <img src = "{{asset('img/w.png')}}" style = "width: 20px; height: auto">
                                Označi kao odgledano
                            </a>

                        @else


                            <a href="{{route('updateunwatched',['id'=>$episode->content_id])}}">
                                <img  class = "img-fluid" src = "{{asset('img/ww.png')}}" style = "width: 20px; height:auto">
                                <i> Odgledano </i>
                            </a>

                        @endif



                    @endif
                </div>

                <div>
                    @if(Auth::check() && Auth::user()->is_admin==true)
                        <a href="#myModal1" data-toggle="modal">
                            <input type="submit" value="Obrisi epizodu" class="btn btn-transparent">
                        </a>
                    @endif
                </div>
            </div>
            <!-- End col-lg-12 -->
        </div>
        <br>
        <br>

        @if(Auth::check())

            <div class="modal" id="myModal1" style="margin-top:15%;color:black;">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color:#2B2C30;color:white">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-size:20px">Brisanje epizode
                                <button style="margin-bottom:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></h5>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da uklonite ovu epizodu?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="{{ route('episoderemove',['id'=>$episode->content_id]) }}">
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


        <div class="row" style="font-size: 15px">

            <div class="col-md-8">
                <div class="row">
                <!--Glavna slika	-->
                    <div class="col-md-6">
                <center><?php $flag=false; ?>

                    @foreach($content->pictures as $picture)
                        <?php if($picture->main_picture==true){ $flag=true; ?>
                            <img src="{{ asset('img/img/content/'.$picture->path) }}" style="width:90%;height:auto">
                            <?php } ?>
                    @endforeach

                    <?php if(!$flag) { ?>
                    <img src="{{ asset('img/default_content.png') }}" style="width:60%;height:auto">

                    <?php }?>


                    @if(Auth::check() && Auth::user()->is_admin==true)
                        <a href="{{route('editepisode',['episode'=>$episode->content_id])}}">
                            <input type="submit" value="Izmeni informacije" class="btn btn-transparent">
                        </a>
                    @endif


                </center>
                <br>
                    </div>


                    <div class="col-md-6">
                <h4>Opis: </h4>
                <p style="width:100%;word-wrap: break-word;font-size:16px;">
                    {{$content->description}}
                </p>

                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">


                        <div id="comments" class="comments-section ">
                            <h4>{{$numcomments}} komentara</h4>
                            <ol class="comment-list">
                                <li id="comment-1">

                                    <!-- Svaki komentar(foreach) ide u ovaj comment wrap-->
                                    <!--Znaci ovdje ce ici foreach-->
                                    @foreach($comments as $comment)

                                        @if($comment->contains_spoiler == 0)
                                            <div class="comment-wrap">
                                                <div class="author-avatar pull-left">
                                                    <!--Slika korisnika-->
                                                    <img src="img/avatar.png" alt="">
                                                </div>
                                                <div class="author-comment">
                                                    <!--Ime korisnika-->
                                                    <cite class="pull-left">
                                                        <!-- DODATI LINK KA PROFILU KORISNIKA -->
                                                        <a href="#">
                                                            @php  $user = App\User::find($comment->user_id)  @endphp
                                                            {{$user->username}}
                                                        </a>
                                                    </cite>
                                                    @if(Auth::check() && Auth::user()->is_admin==true)

                                                        <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a><br>
                                                        <a href="{{ route('updatespoiler',['id'=>$comment->id]) }}" class="replay pull-right">Sadrzi spojlere</a>
                                                    @endif
                                                <!-- PRIAKZI MU KOMENTAR AKO JE ON NJEGOV KREATOR-->
                                                    @if(Auth::check() && Auth::user()->is_admin==false && Auth::user()->id==$comment->user_id)

                                                        <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a>
                                                    @endif

                                                    <div style="clear:both"></div>
                                                    <div class="comment-meta">
                                                        <!--Datum komentara-->
                                                        <i class="fa fa-calendar"></i> {{$comment->created_at->format('m/d/Y')}}
                                                    </div>
                                                    <div class="comment-content">
                                                        <p style="width:100%;word-wrap: break-word;">
                                                            {{$comment->description}}
                                                        </p>
                                                    </div>
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

                                                        <a href="#">
                                                            @php  $user = App\User::find($comment->user_id) @endphp
                                                            {{$user->username}}
                                                        </a>
                                                    </cite>
                                                    @if(Auth::check() && Auth::user()->is_admin==true)

                                                        <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a>
                                                        <br>
                                                        <a href="{{ route('updatespoilerremove',['id'=>$comment->id]) }}" class="replay pull-right">Ne sadrzi spojlere</a>
                                                        <br>
                                                        <a href="#{{$comment->id}}{{$comment->user_id}}" data-toggle="collapse" class="replay pull-right">Prikazi komentar</a>
                                                    @endif
                                                <!-- PRIAKZI MU KOMENTAR AKO JE ON NJEGOV KREATOR-->
                                                    @if(Auth::check() && Auth::user()->is_admin==false && Auth::user()->id==$comment->user_id)

                                                        <a href="{{ route('deletecomment',['id'=>$comment->id]) }}" class="replay pull-right">Ukloni komentar</a>
                                                        <br>


                                                    @endif
                                                    @if(Auth::check() && Auth::user()->is_admin==false)
                                                        <a href="#{{$comment->id}}{{$comment->user_id}}" data-toggle="collapse" class="replay pull-right">Spoiler! Prikazi komentar</a>
                                                    @endif
                                                    <div style="clear:both"></div>
                                                    <div class="comment-meta">
                                                        <!--Datum komentara-->
                                                        <i class="fa fa-calendar"></i> {{$comment->created_at->format('m/d/Y')}}
                                                    </div>
                                                    <div class="comment-content"  >

                                                        <p class="collapse" id="{{$comment->id}}{{$comment->user_id}}"  style="width:100%;word-wrap: break-word;">
                                                            {{$comment->description}}
                                                        </p>
                                                    </div>
                                                </div>



                                            </div>
                                            <br>




                                        @endif
                                    @endforeach

                                </li>
                            </ol>
                        </div>

                            <div class="col-md-12">
                                <center>
                                    {{ $comments->links() }}
                                </center>
                            </div>
                        <!-- Forma za postavljanje komentara-->
                        <div class="col-md-12">
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

                </div>



            </div>


            <div class="col-md-4" style="font-weight: bold">
                <center>
                    @if($content->pictures !=null)
                    <h3>Slike</h3>
                        @endif
                </center>
                <center>

                    @foreach($content->pictures as $picture)
                        <a href="{{ asset('img/img/content/'.$picture->path) }}" data-lightbox="pics">
                                <img src="{{ asset('img/img/content/'.$picture->path) }}" style="width:300px;height:auto;margin-bottom:20px">
                        </a>

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

        <br>
        <br>
    </div>


@endsection