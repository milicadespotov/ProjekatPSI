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
                <img style="width:100%" src="{{asset('img/default_content.png')}}">
            @else
                <img style="width:100%" src="{{asset('img/img/content/'.$pictures[$i]->path)}}">
            @endif
        </div>
        <div class="col-md-8" >

            <table >
                <tr colspan="2">
                    <td>
                        <h2>
                           <strong>
                               <a href="{{route('showseries',['content_id'=>$contents[$i]->id])}}">{{$contents[$i]->name}}</a>
                           </strong>


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
                    <td><strong>Glumci:</strong></td>
                    <td width="30%">
                        @foreach($actors[$i] as $actor)
                            |<a href="/search?selectionForm=serija&search={{$actor->name}}">{{$actor->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
                <tr>
                    <td><strong>Režiseri:</strong></td>
                    <td>
                        @foreach($directors[$i] as $director)
                            |<a href="/search?selectionForm=serija&search={{$director->name}}">{{$director->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
                <tr>
                    <td><strong>Žanr:</strong></td>
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