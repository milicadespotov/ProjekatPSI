@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <center><h1>Serija {{$content->name}}</h1></center>
        </div>
    <form method="POST" enctype="multipart/form-data" action="{{route('confirm_season', ['id'=>$content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="main_picture" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                    <img src="{{asset('img/default_content.png')}}" id="img" style="width:50%;height:auto;">
                    <input type="file" name="mainImage" class="form-control input-file" id="picture" style = "display: none;">
                    <input type = "button" name = "browse_file" id = "browse_file" class = "btn btn-transparent form-control" style = "width: 50%" value = "Dodaj fotografiju">

                </div>
                <div class="form-group">
                    <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Ostale slike:</label><br>
                    <input type="file" name="pictures[]" value="{{ old('pictures') }}" multiple class="form-control" id="pictures">
                </div>
                <div class="form-group">
                    <label for="trailer" style="font-size:18px" class="col-form-label text-md-right color">Trejler:</label>
                    <input type="text" name="trailer" class="form-control" id="trailer" value="{{ old('trailer') }}">
                </div>
                <div class="form-group">
                    <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Ime sezone:</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" style = "{{$errors->has('name') ? 'border-color: deeppink' : ''}}">
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
                    <input type="date" name="releaseDate" value="{{ old('releaseDate') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="episodes" style = "font-size: 18px" class="col-form-label text-md-right color">Broj epizoda:</label>
                    <input type="text" name="episodes" class="form-control" value="{{ old('episodes') }}" style = "{{$errors->has('episodes') ? 'border-color: deeppink' : ''}}">
                    @if ($errors->has('episodes'))
                        <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('episodes') }}
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="numSeason"style = "font-size: 18px" class="col-form-label text-md-right color">Redni broj sezone:</label>
                    <input type="text" name="numSeason" value="{{ old('numSeason') }}" class="form-control" style = "{{$errors->has('numSeason') ? 'border-color: deeppink' : ''}}">
                    @if ($errors->has('numSeason'))
                        <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('numSeason') }}
                                    </span>
                    @endif
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <input type="submit" class="btn btn-transparent" value="Potvrdi">
            <a class="btn btn-transparent" href="{{route('showseries', ['content_id'=>$content->id])}}">Odustani</a>
        </div>
    </form>
</div>

    @endsection