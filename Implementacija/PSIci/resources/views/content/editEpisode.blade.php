@extends('layouts.master')

@section('content')
    <div class="container-fluid">
            <div class="row justify-content-center" style="margin-top:20px;">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mainImage" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                        <form method="post" id="changePictureForm" action="/episode/{{$episode->content_id}}/edit/changeAvatar" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                            <input type="file" name="mainImage" class="form-control input-file" id="mainImage">
                            <input type="button" onclick="submitVal(1)" class="btn btn-transparent" value="Promeni">
                            <input type="button" onclick="submitVal(0)" class="btn btn-transparent" value="Resetuj">
                            <input type="text" value="" id="setPictureOption" hidden>
                        </form>
                    </div>
                    <div class="form-group">
                        <form method="post" action="/episode/{{$episode->content_id}}/edit/addPictures" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                            <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj ostale slike:</label><br>
                            <input type="file" name="pictures[]" multiple class="form-control input-file" id="pictures">
                            <input type="submit" class="btn btn-transparent" value="Dodaj slike">
                        </form>
                    </div>
                    <div class="form-group">
                        <label for="genre" style = "font-size: 18px" class="col-form-label text-md-right color">Odaberi slike za brisanje:</label>
                        <form method="post" action="/episode/{{$episode->content_id}}/edit/addPictures" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <div class="row">
                            <?php $i=0; ?>
                            @foreach($picturePaths as $picPath)
                                <div class="col-lg-4">
                                    <center><input type="checkbox" id={{$picPath->path}} name="paths[]" value="{{$picPath->path}}"></center>
                                    <br>
                                    <label for="{{$picPath->path}}"><img style="width:100%" src="{{ asset('img/img/content/'.$picPath->path) }}"></label>
                                </div>
                            @endforeach
                        </div>
                        <input type="submit" class="btn btn-transparent" value="Obriši slike">
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="post" action="/episode/{{$episode->content_id}}/edit/changeData" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <div class="form-group">
                        <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Naziv epizode:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$content->name}}">
                    </div>
                    <div class="form-group">
                        <label for="trailer" style = "font-size: 18px" class="col-form-label text-md-right color">Trejler:</label>
                        <input type="text" id="trailer" name="trailer" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description" style = "font-size: 18px" class="col-form-label text-md-right color">Opis:</label>
                        <textarea name="description" id="description" class="form-control" value="{{$content->description}}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="duration" style = "font-size: 18px" class="col-form-label text-md-right color">Trajanje epizode: (u minutima)</label>
                        <input type="text" id="duration" name="duration" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-transparent" value="Izmeni detalje">
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <input type="submit" class="btn btn-transparent" value="Dalje">
                <a href="/"><button class="btn btn-transparent">Odustani</button></a>
            </div>
    </div>

@endsection