@extends('layouts.master')


@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12 ">

                <div class="blog-title">
                    <h1>ODGLEDANE EPIZODE</h1>
                </div>
                <hr>
                <br>
                <br>
            </div>
        </div>
            @foreach($watched as $episode)
                <div class="row">

                <div class="col-md-12">


                <article class="entry wow fadeInDown"  data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="col-md-4">
                    <div class="post-thumb" >
                        <a href="#">
                            <!-- PROVJERITI U KOM FOLDERU JE SLIKA I PROMIJENITI PUTANJU -->
                            <img src=<?php $path = 'img/'.$episode->path; echo $path; ?>  style="width:400px;height:auto" class="img-responsive">
                        </a>
                    </div>
                    </div>
                    <div class="col-md-8">
                    <div class="post-excerpt">
                        <!-- DODATI RUTU KOJA VODI NA EPIZODU-->
                        <h3><a href="{{route('showepisode',['id'=>$episode->content_id])}}">{{$episode->name}}</a></h3>

                       <br>

                        <blockquote>
                            <p style="word-wrap: break-word;">
                                {{$episode->description}}
                            </p>
                        </blockquote>

                        <p> {{$episode->description}} </p>
                    </div>
                    <div class="post-meta">
                        <span class="post-date">
										<i class="fa fa-calendar"></i>{{\Carbon\Carbon::parse($episode->release_date)->format('d/m/Y')}}
                        </span>
                        <span class="comments">
										<i class="fa fa-star"></i>{{$episode->rating}}
                        </span>
                        <span class="comments">
                            <i class="fa fa-image"></i>{{$episode->number_of_pictures}}
                        </span>

                    </div>
                    </div>
                </article>





                </div>

                </div>
                <br><br>
            <br><br>
            @endforeach


        <div class="row">
            <div class="col-md-12">
                <center>
                    {{ $watched->links() }}
                </center>
            </div>
        </div>
    </div>

@endsection