@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <br>
    <br>
    <br>
@for($i=0;$i<sizeof($tvshows);$i++)
    <div class="row">

        <div class="col-md-4">
            @if ($pictures[$i]==null)
                <img style="width:100%" src="{{asset('img/no_image.png')}}">
            @else
                <img style="width:100%" src="{{asset('img/content/'.$pictures[$i]->path)}}">
            @endif
        </div>
        <div class="col-md-8" width="100%">
            <table>
                <tr colspan="2">
                    <td>
                        <h2>
                            <a href="{{route('showseries',['content_id'=>$contents[$i]->id])}}">{{$contents[$i]->name}}</a>


                        </h2>
                    </td>
                </tr>
                <tr>
                    <td >
                        <p style="width:100%;word-wrap: break-word;">
                                {{$contents[$i]->description}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>Glumci:</td>
                    <td width="30%">
                        @foreach($actors[$i] as $actor)
                            |<a href="/search?selectionForm=serija&search={{$actor->name}}">{{$actor->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
                <tr>
                    <td>Režiseri:</td>
                    <td>
                        @foreach($directors[$i] as $director)
                            |<a href="/search?selectionForm=serija&search={{$director->name}}">{{$director->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
                <tr>
                    <td>Žanr:</td>
                    <td>
                        @foreach($genres[$i] as $genre)
                            |<a href="/search?selectionForm=serija&search={{$genre->name}}">{{$genre->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <br>
@endfor
</div>
<br> <br> <br>
@endsection