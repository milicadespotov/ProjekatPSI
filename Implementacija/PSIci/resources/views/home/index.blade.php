@extends('layouts.master')

@section('content')


    <br>
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
            <center>
                <h2>Najpopularnije serije</h2>
                <br>
                <br>
            </center>
            <div class="row">


                @for($i=0;$i<sizeof($mostPopular);$i++)

                <div class="col-md-12" style="margin-bottom:10px">
                    <div class="col-md-4">

                        @if($picturesMP[$i]!=null)
                            <img src="{{asset('img/img/content/'.$picturesMP[$i]->path)}}" style="width:100%">
                        @else
                            <img src="{{asset('img/default_content.png')}}" style="width:100%">
                        @endif



                    </div>
                    <div class="col-md-8">
                        <h4><a href="{{route('showseries',['id'=>$mostPopular[$i]->id])}}">{{$mostPopular[$i]->name}}</a></h4>
                       <p style="width:100%;word-wrap: break-word;">
                           {{ substr($mostPopular[$i]->description,0,255) }}...
                       </p>

                    </div>

                </div>




                @endfor


            </div>
        </div>
        <div class="col-md-6">
            <center>
                <h2>Predstojeće serije</h2>
                <br>
                <br>
            </center>
            <div class="row">

                @for($i=0;$i<sizeof($upcoming);$i++)
                <div class="col-md-12" style="margin-bottom:10px">
                    <div class="col-md-4">
                        @if($picturesUpcoming[$i]!=null)
                            <img src="{{asset('img/img/content/'.$picturesUpcoming[$i]->path)}}" style="width:100%">
                        @else
                            <img src="{{asset('img/default_content.png')}}" style="width:100%">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h4><a href="{{route('showseries',['id'=>$upcoming[$i]->id])}}">{{$upcoming[$i]->name}}</a></h4>
                        <p style="width:100%;word-wrap: break-word;">
                            {{substr($upcoming[$i]->description,0,255) }} ...
                        </p>

                    </div>

                </div>


                @endfor

            </div>
        </div>

    </div>
        <div class="row">
            <div class="col-md-6">
                <center>
                    <a href="{{route('mostpopular')}}">
                        <input type="submit" value="Pogledaj vise" class="btn btn-transparent">
                    </a>
                </center>
            </div>
            <div class="col-md-6">
                <center>
                    <a href="{{route('upcoming')}}">
                        <input type="submit" value="Pogledaj vise" class="btn btn-transparent">
                    </a>
                </center>
            </div>
        </div>

    </div>

    <br>
    <br>
    <br>
    <br>

@endsection