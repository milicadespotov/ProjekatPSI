@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <center><h1>Sezona {{$content->name}}</h1></center>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{route('confirm_episode', ['id'=>$content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="main_picture" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                        <input type="file" name="mainImage" class="form-control" id="mainImage">
                    </div>
                    <div class="form-group">
                        <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Ostale slike:</label><br>
                        <input type="file" name="pictures[]" multiple class="form-control" id="pictures">
                    </div>
                    <div class="form-group">
                        <label for="trailer" style="font-size:18px" class="col-form-label text-md-right color">Trejler:</label>
                        <input type="text" name="trailer" class="form-control" id="trailer" value="{{ old('trailer') }}">
                    </div>
                    <div class="form-group">
                        <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Ime epizode:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" style = "{{$errors->has('name') ? 'border-color: deeppink' : ''}}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description" style = "font-size: 18px" class="col-form-label text-md-right color">Kratak opis:</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="releaseDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum izlaska:</label>
                        <input type="date" name="releaseDate" class="form-control" value="{{ old('releaseDate') }}">
                    </div>

                    <div class="form-group">
                        <label for="duration" style = "font-size: 18px" class="col-form-label text-md-right color">Duzina epizode:</label>
                        <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" style = "{{$errors->has('duration') ? 'border-color: deeppink' : ''}}">
                        @if ($errors->has('duration'))
                            <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('duration') }}
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="numEpisode" style = "font-size: 18px" class="col-form-label text-md-right color">Redni broj epizode:</label>
                        <input type="text" name="numEpisode" value="{{ old('numEpisode') }}" class="form-control" style = "{{$errors->has('numEpisode') ? 'border-color: deeppink' : ''}}">
                        @if ($errors->has('numEpisode'))
                            <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('numEpisode') }}
                                    </span>
                        @endif
                    </div>


                </div>
            </div>
            <div class="row justify-content-center">
                <input type="submit" class="btn btn-transparent" value="Potvrdi">
                <a class="btn btn-transparent" href="{{route('season', ['id'=>$content->id])}}">Odustani</a>
            </div>
        </form>
    </div>

@endsection