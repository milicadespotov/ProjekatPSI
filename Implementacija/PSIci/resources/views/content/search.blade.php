@extends('layouts.master')

@section('content')

@for($i=0;$i<sizeof($tvshows);$i++)
    <div class="row">

        <div class="col-md-4">
            @if ($pictures[$i]==null)
                <img style="width:100%" src="{{asset('img/content/favicon.png')}}">
            @else
                <img style="width:100%" src="{{asset('img/content/'.$pictures[$i]->path)}}">
            @endif
        </div>
        <div class="col-md-8">
            <table>
                <tr colspan="2">
                    <td>
                        <a href="">{{$contents[$i]->name}}</a>
                    </td>
                </tr>
                <tr>
                    <td>
                    {{$contents[$i]->description}}
                    </td>
                </tr>
                <tr>
                    <td>Glumci:</td>
                    <td>
                        @foreach($actors[$i] as $actor)

                        |{{$actor->name}}|
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Režiseri:</td>
                    <td>
                        @foreach($directors[$i] as $director)
                            |{{$director->name}}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Žanr:</td>
                    <td>
                        @foreach($genres[$i] as $genre)
                        |{{$genre->name}}|
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>

    </div>

@endfor

@endsection