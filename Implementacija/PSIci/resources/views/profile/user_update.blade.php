@extends('layouts.master')


@section('content')
    <div class="backgroundLogin">
    <br>
    <br>
    <div class="container-fluid">
        <div class="row">
            <form id="info-form" method="post" action="{{ route('postinfoupdate')}}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                @csrf
                <fieldset>
                    <div class="col-md-1">
                        &nbsp;
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('img/got.jpg') }}" style="width:100%">
                        <center>
                        <div class="input-group" style="margin-top: 20px">
                            <input id="picture" name="picture" class="input-file" type="file" >

                        </div>
                        </center>
                    </div>
                    <div class="col-md-1"> &nbsp; </div>
                    <div class="col-md-5">
                        <div class="form-group ">
                            <label class="control-label" for="firstname" >Ime:</label>

                                <input id="name" name="name" placeholder="Unesite ime" class="form-control input-md" type="text" value="{{ Request::old('name') ? Request::old('name') : $user->name}}">
                                <div class ="text-danger">  {{ $errors->first('name') }}</div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class=" control-label" for="surname">Prezime:</label>

                                <input id="surname" name="surname" placeholder="Unesite prezime" class="form-control input-md" type="text" value="{{ Request::old('surname') ? Request::old('surname') : $user->surname}}">
                                <div class ="text-danger">  {{ $errors->first('surname') }}</div>

                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="control-label" for="email">E-mail:</label>

                                <input id="email" name="email" placeholder="example@ex.com" class="form-control input-md" type="text" value="{{ Request::old('email') ? Request::old('email') : $user->email}}" >
                                <div class ="text-danger">  {{ $errors->first('email') }}</div>

                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="control-label" for="gender">Pol:</label>  <br>
                                <input type="radio" name="gender" value="m" checked>Muski &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="z" >Zenski
                                <div class ="text-danger">  {{ $errors->first('gender') }}</div>

                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="control-label" for="birthdate" >Datum rodjenja:</label>

                                <input id="birth_date" name="birth_date" class="form-control " type="date" value="{{ Request::old('birth_date') ? Request::old('birth_date') : $user->birth_date}}">
                                <div class ="text-danger">  {{ $errors->first('birth_date') }}</div>

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