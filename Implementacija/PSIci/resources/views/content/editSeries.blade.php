
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
                    <div class="col-lg-offset-4 col-lg-4">
                        @if ($avatarPath!=null)
                            <img src="{{ asset('img/img/content/'.$avatarPath->path) }}" style="width:100%">
                        @else
                            <img src="{{asset('img/img/content/episode_default.jpg')}}" style="width:100%">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="mainImage" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                    <form enctype="multipart/form-data" method="post" id="changePictureForm" action="/series/{{$tvshow->content_id}}/edit/changeAvatar" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <input type="file" name="mainImage" class="form-control input-file" id="mainImage">
                        <input type="button" onclick="submitVal(1)" class="btn btn-transparent" value="Promeni">
                        <input type="button" onclick="submitVal(0)" class="btn btn-transparent" value="Resetuj">
                        <input type="text" name="typeOfOperation" value="" id="setPictureOption" hidden>
                    </form>
                </div>
                <div class="form-group">
                    <form enctype="multipart/form-data" method="post" action="/series/{{$tvshow->content_id}}/edit/addPictures" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj ostale slike:</label><br>
                        <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="pictures">
                        <br>
                        <input type="submit" class="btn btn-transparent" value="Dodaj slike">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
                <div class="form-group">
                    <form enctype="multipart/form-data" method="post" action="/series/{{$tvshow->content_id}}/edit/addPictures" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj ostale slike:</label><br>
                        <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="pictures">
                        <br>
                        <input type="submit" class="btn btn-transparent" value="Dodaj slike">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
                <div class="form-group">

                    <form enctype="multipart/form-data" method="post" action="/series/{{$tvshow->content_id}}/edit/changeGenres" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">

                        <label for="genre" style = "font-size: 18px" class="col-form-label text-md-right color">Žanr:</label>

                        <table cell-padding="20px">

                            <?php $i=0;
                                if ($i%4==0) echo '<tr>';
                            ?>
                            @foreach($checkBoxArr as $cb)
                                <?php
                                if ($i%4==0) echo '<tr>';
                                ?>
                                <td style="padding:10px">
                                    <label for="{{$cb['name']}}"><?php echo ucfirst($cb['name']);?>:</label></td><td style="padding:10px">
                                    <input type="checkbox" name="genre[]" value="{{$cb['id']}}" id="{{$cb['name']}}"
                                    @if ($cb['check']!=null) {{'checked'}}
                                    @endif>
                                </td>
                                <?php
                                    $i=$i+1;
                                    if ($i%4==0) echo '</tr>'
                                ?>

                            @endforeach
                            <?php
                                if ($i%4!=0) echo '</tr>';
                            ?>
                        </table>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-transparent" value="Promeni žanr">
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <form enctype="multipart/form-data" method="post" action="/series/{{$tvshow->content_id}}/edit/changeData" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Naziv epizode:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$content->name}}" required>
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
                    <div class="form-group">
                        <label for="releaseDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum izlaska:</label>
                        <input type="date" name="releaseDate" class="form-control" id="releaseDate">
                    </div>
                    <input type="submit" class="btn btn-transparent" value="Izmeni detalje">
                </form>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top:20px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label style = "font-size: 18px" class="col-form-label text-md-right color">Odaberi slike za brisanje:</label>
                    <form method="post" enctype="multipart/form-data" action="/series/{{$tvshow->content_id}}/edit/deletePictures" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
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