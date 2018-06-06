@extends('layouts.master')


@section('content')
    <div class="backgroundLogin">
    <br>
    <br>
    <div class="container-fluid">
        <div class="row" style="font-size:18px;color:#8A2BE2">
            <form id="info-form" enctype= "multipart/form-data" method="post" action="{{ route('postinfoupdate')}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                @csrf
                <fieldset>
                    <div class="col-md-1">
                        &nbsp;
                    </div>
                    <div class="col-md-4">



                        <center>
                            <img id = "img" src=<?php if(is_null($user->picture_path)){ echo 'img/avatar.png' ;} else {$path = 'img/img/users/'.$user->picture_path; echo $path; } ?> style="width:400px;margin-bottom:25px;">
                            <input id="picture" name="picture" class="input-file" type="file" value="{{ Request::old('picture') }}" style = "display: none">
                            <input type = "button" name = "browse_file" id = "browse_file" class = "btn btn-transparent form-control" style = "width: 50%" value = "Izmeni fotografiju">
                            <div style="color:deeppink">  {{ $errors->first('picture') }}</div>
                        </center>
                    </div>
                    <div class="col-md-1"> &nbsp; </div>
                    <div class="col-md-5">
                        <div class="form-group ">
                            <label class="control-label" for="firstname" >Ime:</label>

                                <input id="name" name="name" placeholder="Unesite ime" class="form-control input-md" type="text" value="{{ Request::old('name') ? Request::old('name') : $user->name}}">
                                <div style="color:deeppink">  {{ $errors->first('name') }}</div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class=" control-label" for="surname">Prezime:</label>

                                <input id="surname" name="surname" placeholder="Unesite prezime" class="form-control input-md" type="text" value="{{ Request::old('surname') ? Request::old('surname') : $user->surname}}">
                                <div style="color:deeppink">  {{ $errors->first('surname') }}</div>

                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="control-label" for="email">E-mail:</label>

                                <input id="email" name="email" placeholder="example@ex.com" class="form-control input-md" type="text" value="{{ Request::old('email') ? Request::old('email') : $user->email}}" >
                                <div style="color:deeppink">  {{ $errors->first('email') }}</div>

                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="control-label" for="gender">Pol:</label>  <br>
                                <input type="radio" name="gender" value="m" checked>Muski &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="z" >Zenski
                                <div style="color:deeppink">  {{ $errors->first('gender') }}</div>

                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="control-label" for="birthdate" >Datum rodjenja:</label>

                                <input id="birth_date" name="birth_date" class="form-control " type="date" value="{{ Request::old('birth_date') ? Request::old('birth_date') : $user->birth_date}}">
                                <div style="color:deeppink">  {{ $errors->first('birth_date') }}</div>

                        </div>
                        <br>
                        <div class="form-group">

                            <center>
                                <button type="submit" class="btn btn-transparent">Potvrdi</button>
                            </center>

                        </div>
                    </div>
                    <div class="col-md-1">
                        &nbsp;
                    </div>
                </fieldset>
            </form>
            <form>


            </form>
        </div>

    </div>


    <br>
    <br>
    </div>
@endsection