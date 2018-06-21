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
            <div class="row">

            </div>
            <table style="border-collapse: separate;border-spacing: 1.5em;">
                <tr >
                    <td colspan="2">
                        <h2>
                           <strong>
                               <a href="{{route('showseries',['content_id'=>$contents[$i]->id])}}">{{$contents[$i]->name}}</a>
                           </strong>
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" width=80%">
                        <!-- Privremeno rjesenje za prelom teksta-->
                        <div class="col-md-12">

                            <p style="width:100%;word-wrap: break-word;">
                                {{ substr($contents[$i]->description,0,350) }}...
                            </p>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td><strong>Glumci:</strong></td>
                    <td width="70%">
                        @foreach($actors[$i] as $actor)
                            |<a href="{{route('search')}}?selectionForm=glumci&search={{$actor->name}}">{{$actor->name}}</a>
                        @endforeach|
                    </td>
                </tr>
                <tr>
                    <td><strong>Režiseri:</strong></td>
                    <td width="70%">
                        @foreach($directors[$i] as $director)
                            |<a href="{{route('search')}}?selectionForm=reziseri&search={{$director->name}}">{{$director->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
                <tr>
                    <td><strong>Žanr:</strong></td>
                    <td>
                        @foreach($genres[$i] as $genre)
                            |<a href="{{route('search')}}?selectionForm={{$genre->name}}&search=">{{$genre->name}}</a>
                        @endforeach
                        |
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
@endfor
    
</div>

<br> <br> <br>
@endsection