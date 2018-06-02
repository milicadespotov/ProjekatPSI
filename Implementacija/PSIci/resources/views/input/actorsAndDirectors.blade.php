@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2>{{$content->name}}</h2>
                <table>
                    <tr>
                        <td>
                            <b>Datum objavljivanja:</b>
                            {{$content->release_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Opis:</b>
                            {{$content->description}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Država:</b>
                            {{$tvshow->country}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Jezik:</b>
                            {{$tvshow->language}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <b>Prosečna dužina epizode:</b>
                        {{$tvshow->length}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Datum završetka:</b>
                            {{$tvshow->end_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Broj epizoda:</b>
                            {{$tvshow->number_of_episodes}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Glumci:</b><br>
                            @foreach($actors as $actor)
                                {{$actor->name}}<br>
                                @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Režiseri:</b><br>
                            @foreach($directors as $director)
                                {{$director->name}}<br>
                            @endforeach
                        </td>
                    </tr>


                </table>
            </div>
            <div class="col-lg-6">
                <form method="POST" enctype="multipart/form-data" action="/addActor/{{$content->id}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group">
                        <label for="actor">Glumac:</label>
                        <input type="text" name="actor" class="form-control">
                        <input style="margin-top:15px" type="submit" class="btn btn-transparent" value="Dodaj glumca">
                    </div>

                </form>
                <br>
                <form method="POST" enctype="multipart/form-data" action="/addDirector/{{$content->id}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group">
                        <label for="actor">Režiser:</label>
                        <input type="text" name="director" class="form-control">
                        <input style="margin-top:15px" type="submit" class="btn btn-transparent" value="Dodaj režisera">
                    </div>

                </form>
                <br>
                <center>  <a href="/series/{{$content->id}}"><button class="btn btn-transparent">Potvrdi</button></a></center>
            </div>
        </div>
    </div>
    @endsection