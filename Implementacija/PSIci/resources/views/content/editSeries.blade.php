
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
                <div class="form-group">
                    <form enctype="multipart/form-data" method="post" id="changePictureForm" action="{{route('avatar_tvshow',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <label for="main_picture" style = "font-size: 18px" class="col-form-label text-md-right color">Naslovna slika:</label><br>
                        @if ($avatarPath!=null)
                            <img src="{{ asset('img/img/content/'.$avatarPath->path) }}" id="img" style="width:50%">
                        @else
                            <img src="{{asset('img/default_content.png')}}" style="width:50%" id="img">
                        @endif
                        <input type="file" name="mainImage" class="form-control input-file" id="picture" style = "display: none;"><br>
                        <input type = "button" name = "browse_file" id = "browse_file" class = "btn btn-transparent form-control" style = "width: 30%" value = "Dodaj fotografiju">

                        <br>
                        <input type="button" onclick="submitVal(1)" class="btn btn-transparent" value="Promeni">
                        <input type="button" onclick="submitVal(0)" class="btn btn-transparent" value="Resetuj">
                        <input type="text" name="typeOfOperation" value="" id="setPictureOption" hidden>
                    </form>
                </div>
                <div class="form-group">
                    <form enctype="multipart/form-data" method="post" action="{{route('add_pic_tvshow',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <label for="pictures" style = "font-size: 18px" class="col-form-label text-md-right color">Dodaj ostale slike:</label><br>
                        <input type="file" style="margin-top:3px;" name="pictures[]" multiple class="form-control input-file" id="pictures">
                        <br>
                        <input type="submit" class="btn btn-transparent" value="Dodaj slike">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
                <div class="form-group">

                    <form enctype="multipart/form-data" method="post" action="{{route('tvshow_genre',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">

                        <label for="genre" style = "font-size: 18px" class="col-form-label text-md-right color">Žanr:</label>

                        <table cell-padding="20px">

                            <?php $i=0; ?>
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
                <form method="POST" enctype="multipart/form-data" action="{{route('tvshow_actor_add',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group">
                        <label for="actor">Glumac:</label>
                        <input type="text" name="actor" class="form-control">
                        <input style="margin-top:15px" type="submit" class="btn btn-transparent" value="Dodaj glumca">
                    </div>

                </form>
                <form method="POST" enctype="multipart/form-data" action="{{route('tvshow_director_add',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <div class="form-group">
                        <label for="actor">Režiser:</label>
                        <input type="text" name="director" class="form-control">
                        <input style="margin-top:15px" type="submit" class="btn btn-transparent" value="Dodaj režisera">
                    </div>

                </form>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
                <a href="{{route('showseries',['id' => $content->id])}}"><center><button type="button" class="btn btn-transparent" value="">Vrati se na seriju</button></center></a>
            </div>
            <form enctype="multipart/form-data" method="post" action="{{route('change_tvshow',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <div class="form-group">
                    <label for="name" style = "font-size: 18px" class="col-form-label text-md-right color">Ime serije:</label>
                    <input type="text" name="name" value="<?php if (old('name')==null) echo $content->name; else echo old('name');?>" class="form-control" style="{{$errors->has('name')?'border-color: deeppink': ''}};" id="name">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" style = "color: deeppink">
                                            {{ $errors->first('name') }}
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="trailer" style="font-size:18px" class="col-form-label text-md-right color">Trejler:</label>
                    <input type="text" name="trailer" class="form-control" id="trailer" value="<?php if (old('trailer')==null) echo $content->trailer; else echo old('trailer');?>">
                </div>
                <div class="form-group">
                    <label for="description" style = "font-size: 18px" class="col-form-label text-md-right color">Kratak opis:</label>
                    <textarea name="description" class="form-control" id="description"><?php if (old('description')==null) echo $content->description; else echo old('description');?></textarea>
                </div>
                <div class="form-group">
                    <label for="releaseDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum izlaska:</label>
                    <input type="date" value="<?php if (old('releaseDate')==null) echo substr($content->release_date,0,10); else echo substr(old('releaseDate'),0,10);?>"name="releaseDate" class="form-control" id="releaseDate" >
                </div>
                <div class="form-group">
                    <label for="country" style = "font-size: 18px" class="col-form-label text-md-right color">Zemlja porekla:</label>
                    <input type="text" name="country" class="form-control" id="country" value="<?php if (old('country')==null) echo $tvshow->country; else echo old('country');?>">
                </div>
                <div class="form-group">
                    <label for="language" style = "font-size: 18px" class="col-form-label text-md-right color">Jezik:</label>
                    <input type="text" name="language" value="<?php if (old('language')==null) echo $tvshow->language; else echo old('language');?>"class="form-control" id="language">
                </div>
                <div class="form-group">
                    <label for="duration" style = "font-size: 18px" class="col-form-label text-md-right color">Trajanje epizode: (u minutima)</label>
                    <input type="text" name="duration" value="<?php if (old('duration')==null) echo $tvshow->length; else echo old('duration');?>" class="form-control" style="{{$errors->has('duration')?'border-color: deeppink': ''}}" id="duration">
                    @if ($errors->has('duration'))
                        <span class="invalid-feedback" style = "color: deeppink">
                                            {{ $errors->first('duration') }}
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="endDate" style = "font-size: 18px" class="col-form-label text-md-right color">Datum završetka:</label>
                    <input type="date" name="endDate" class="form-control" id="endDate" value="<?php if (old('endDate')==null) echo substr($tvshow->end_date,0,10); else echo substr(old('endDate'),0,10);?>">
                </div>
                <div class="form-group">
                    <label for="episodes" style = "font-size: 18px" class="col-form-label text-md-right color">Broj epizoda:</label>
                    <input type="text" name="episodes" value="<?php if (old('episodes')==null) echo $tvshow->number_of_episodes; else echo old('episodes');?>" class="form-control" style="{{$errors->has('episodes')?'border-color: deeppink': ''}}" id="episodes">
                    @if ($errors->has('episodes'))
                        <span class="invalid-feedback" style = "color: deeppink">
                                            {{ $errors->first('episodes') }}
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
                    <form method="post" enctype="multipart/form-data" action="{{route('delete_pic_tvshow',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <label style = "font-size: 18px" class="col-form-label text-md-right color">Odaberi slike za brisanje:</label>

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
                        <input type="submit" style="margin-left:0px" class="btn btn-transparent" value="Obriši slike">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
                <div class="form-group">

                    <form enctype="multipart/form-data" method="post" action="{{route('tvshow_actor_delete',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">

                        <label for="genre" style = "font-size: 18px" class="col-form-label text-md-right color">Odaberi glumce za brisanje:</label>

                        <table cell-padding="20px">

                            <?php $i=0; ?>
                            @foreach($actors as $actor)
                                <?php
                                if ($i%6==0) echo '<tr>';
                                ?>
                                <td style="padding:10px">
                                    <label for="{{$actor->name}}"><?php echo ucfirst($actor->name);?>:</label></td><td style="padding:10px">
                                    <input type="checkbox" name="actors[]" value="{{$actor->id}}" id="{{$actor->name}}">
                                </td>
                                <?php
                                $i=$i+1;
                                if ($i%6==0) echo '</tr>'
                                ?>

                            @endforeach
                            <?php
                            if ($i%6!=0) echo '</tr>';
                            ?>
                        </table>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-transparent" value="Obriši glumce">
                    </form>
                </div>
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="{{route('tvshow_director_delete',['tvshow' => $content->id])}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <label style = "font-size: 18px" class="col-form-label text-md-right color">Odaberi režisere za brisanje:</label>

                            <table cell-padding="20px">
                            <?php $i=0; ?>
                            @foreach($directors as $director)
                                <?php
                                if ($i%6==0) echo '<tr>';
                                ?>
                                <td style="padding:10px">
                                    <label for="{{$director->name}}"><?php echo ucfirst($director->name);?>:</label></td><td style="padding:10px">
                                    <input type="checkbox" name="directors[]" value="{{$director->id}}" id="{{$director->name}}">
                                </td>
                                <?php
                                $i=$i+1;
                                if ($i%6==0) echo '</tr>'
                                ?>

                            @endforeach
                            <?php
                            if ($i%6!=0) echo '</tr>';
                            ?>
                            </table>
                        <input type="submit" class="btn btn-transparent" value="Obriši režisere">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection