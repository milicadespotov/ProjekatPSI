@extends('layouts.master')
@section('content')
    <script language="javascript">
        function submitVal(num) {
            document.getElementById("setPictureOption").value=""+num;
            document.getElementById("changePictureForm").submit();
        }
    </script>
    <div class="container">
        <div class="row justify-content-center" style="margin-top:20px;">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($avatarPath!=null)
                            <img src="{{ asset('img/img/content/'.$avatarPath->path) }}" style="width:100%">
                        @else
                            <img src="{{asset('img/img/content/default_content.png')}}" style="width:100%">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="mainImage" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                    <form enctype="multipart/form-data" method="post" id="changePictureForm" action="{{route('avatar_season',['season' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <input type="file" name="mainImage" class="form-control input-file" id="mainImage">
                        <input type="button" onclick="submitVal(1)" class="btn btn-transparent" value="Promeni">
                        <input type="button" onclick="submitVal(0)" class="btn btn-transparent" value="Resetuj">
                        <input type="text" name="typeOfOperation" value="" id="setPictureOption" hidden>
                    </form>
                </div>
                <div class="form-group">
                    <form enctype="multipart/form-data" method="post" action="{{route('add_pic_season',['season' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj ostale slike:</label><br>
                        <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="pictures">
                        <br>
                        <input type="submit" class="btn btn-transparent" value="Dodaj slike">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <a href="{{route('season',['id' => $content->id])}}"><center><button type="button" class="btn btn-transparent" value="">Vrati se na sezonu</button></center></a>
                </div>
                <form enctype="multipart/form-data" method="post" action="{{route('change_season',['season' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Naziv sezone:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php if (old('name')==null) echo $content->name; else echo old('name');?>" style = "{{$errors->has('name') ? 'border-color: deeppink' : ''}}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="trailer" style = "font-size: 18px" class="col-form-label text-md-right color">Trejler:</label>
                        <input type="text" value="<?php if (old('trailer')==null) echo $content->trailer; else echo old('trailer');?>" id="trailer" name="trailer" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description" style = "font-size: 18px" class="col-form-label text-md-right color">Opis:</label>
                        <textarea name="description" id="description" class="form-control"><?php if (old('description')==null) echo $content->description; else echo old('description');?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="releaseDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum izlaska:</label>
                        <input type="date" name="releaseDate" class="form-control" id="releaseDate" value="<?php if (old('releaseDate')==null) echo substr($content->release_date,0,10); else echo substr(old('releaseDate'),0,10);?>">
                    </div>
                    <div class="form-group">
                        <label for="episodes" style = "font-size: 18px" class="col-form-label text-md-right color">Broj epizoda:</label>
                        <input type="text" name="episodes" class="form-control" value="<?php if (old('episodes')==null) echo $season->number_of_episodes; else echo old('episodes');?>" style = "{{$errors->has('episodes') ? 'border-color: deeppink' : ''}}">
                        @if ($errors->has('episodes'))
                            <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('episodes') }}
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="numSeason"style = "font-size: 18px" class="col-form-label text-md-right color">Redni broj sezone:</label>
                        <input type="text" name="numSeason" value="<?php if (old('numSeason')==null) echo $season->season_number; else echo old('numSeason');?>" class="form-control" style = "{{$errors->has('numSeason') ? 'border-color: deeppink' : ''}}">
                        @if ($errors->has('numSeason'))
                            <span class="invalid-feedback" style="color:deeppink">
                                        {{ $errors->first('numSeason') }}
                                    </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-lg btn-transparent" value="Izmeni detalje">
                </form>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top:20px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label style = "font-size: 18px" class="col-form-label text-md-right color">Odaberi slike za brisanje:</label>
                    <form method="post" enctype="multipart/form-data" action="{{route('delete_pic_season',['season' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <div class="row">
                            <?php $i=0; ?>
                            @foreach($picturePaths as $picPath)
                                <?php
                                if ($i%6==0) echo '<div class="row">';
                                ?>
                                <div class="col-lg-2">
                                    <center><input type="checkbox" id={{$picPath->path}} name="paths[]" value="{{$picPath->path}}"></center>
                                    <br>
                                    <label for="{{$picPath->path}}"><img style="width:100%" src="{{ asset('img/img/content/'.$picPath->path) }}"></label>
                                </div>
                                <?php
                                $i=$i+1;
                                if ($i%6==0) echo '</div>';
                                ?>
                            @endforeach
                        </div>
                        <input type="submit" class="btn btn-transparent" value="Obriši slike">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection