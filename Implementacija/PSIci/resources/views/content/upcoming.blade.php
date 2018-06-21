@extends('layouts.master')


@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12 ">

                <div class="blog-title">
                    <h1>PREDSTOJEĆE SERIJE</h1>
                </div>
                <hr>
                <br>
                <br>
            </div>
        </div>
        @for($i=0;$i<sizeof($upcoming);$i++)
            <div class="row">

                <div class="col-md-12">


                    <article class="entry wow fadeInDown"  data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="col-md-4">
                            <div class="post-thumb" >
                                <a href="#">
                                    <!-- PROVJERITI U KOM FOLDERU JE SLIKA I PROMIJENITI PUTANJU -->
                                    @if($picturesUpcoming[$i]!=null)
                                        <a href="{{asset('img/img/content/'.$picturesUpcoming[$i]->path)}}" data-lightbox="MPpic">
                                            <img src="{{asset('img/img/content/'.$picturesUpcoming[$i]->path)}}" style="width:100%">
                                        </a>
                                    @else
                                        <img src="{{asset('img/default_content.png')}}" style="width:100%">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="post-excerpt">
                                <!-- DODATI RUTU KOJA VODI NA EPIZODU-->
                                <h3><a href="{{route('showseries',['id'=>$upcoming[$i]->id])}}">{{$upcoming[$i]->name}}</a></h3>

                                <br>



                                <p style="word-wrap: break-word;"> {{ substr($upcoming[$i]->description,0,350) }}... </p>
                            </div>
                            <div class="post-meta">
                                 <span class="post-date">
                                                <i class="fa fa-calendar"></i>{{\Carbon\Carbon::parse($upcoming[$i]->release_date)->format('d/m/Y')}}
                                </span>
                                <span class="comments">
                                                <i class="fa fa-star"></i>{{$upcoming[$i]->rating}}
                                </span>
                                <span class="comments">
                                    <i class="fa fa-image"></i>{{$upcoming[$i]->number_of_pictures}}
                                </span>

                            </div>
                        </div>
                    </article>





                </div>

            </div>
            <br><br>

            <hr>
        @endfor


        <div class="row">
            <div class="col-md-12">
                <center>
                    {{ $upcoming->links() }}
                </center>
            </div>
        </div>
    </div>

@endsection