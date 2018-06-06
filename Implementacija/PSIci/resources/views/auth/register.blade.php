@extends('layouts.master')


@section('content')
    <div class = "backgroundLoginI" style="width:100%">
        <div class="container-fluid" style="width:100%">



            <br> <br> <br> <br>
            <h3 style = "color: grey;"> <center> {{ __('Napravite svoj nalog i postanite deo galaksije pravih zaljubljenika u serije!') }} </center></h3>
            <br> <br> <br>

                <form method="POST" enctype= "multipart/form-data" class = "contact-form fadeInUp color" data-wow-duration="500ms" data-wow-delay="300ms" action="{{ route('register') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class = "col-md-12">
                    @csrf
                    <div class="col-md-6 pull-left">
                        <!-- User name REQUESTED WANT -->
                        <div class="form-group row">
                            <label for = "username" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Korisničko ime:*') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" style = "{{$errors->has('username')?'border-color: deeppink': ''}}" name="username" value="{{ old('username') }}"  autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                            {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Name NOT REQUEST -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px"   style = "">{{ __('Ime: ') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" style = "{{$errors->has('name')?'border-color: deeppink':'' }}" autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                {{ $errors->first('name') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Prezime:') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname"  value="{{ old('surname') }}"   style = "{{$errors->has('surname')?'border-color: deeppink':''}}" autofocus>
                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                    <strong>{{ $errors->first('surname') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Pol:') }}</label>

                            <div class="col-md-6">
                                <div class = "radio">
                                    <label> <input type = "radio" name = "gender" value = "m"> Muski </label>
                                </div>
                                <div class = "radio">
                                    <label > <input type = "radio" name = "gender" value = "f"> Zenski</label>
                                </div>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for = "security_question" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Bezbednosno pitanje:*') }}</label>

                            <div class="col-md-6">
                                <input id="security_question" type="text" class="form-control{{ $errors->has('security_question') ? ' is-invalid' : '' }}" name="security_question" value="{{ old('security_question') }}"   style = "{{$errors->has('security_question')?'border-color: deeppink':''}}"  autofocus>

                                @if ($errors->has('security_question'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                {{ $errors->first('security_question') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 pull-right">
                        <div class="form-group row">
                            <label for = "answer" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Odgovor:*') }}</label>

                            <div class="col-md-6">
                                <input id="answer" type="text" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" value="{{ old('answer') }}" style = "{{$errors->has('answer')?'border-color: deeppink':''}}"  autofocus>

                                @if ($errors->has('answer'))
                                    <span class="invalid-feedback" style = "color: #ff0071">
                                                {{ $errors->first('answer') }}
                                            </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('E-Mail Adresa:*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" style = "{{$errors->has('email')?'border-color: deeppink':''}}"  >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style = "color: #ff0071">
                                               {{ $errors->first('email') }}
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;" >{{ __('Lozinka:*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" style = "{{$errors->has('password')?'border-color: deeppink':''}}" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                {{ $errors->first('password') }}
                                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;"> {{ __('Loznka Ponovljena:*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirm" style = "{{$errors->has('password_confirm')?'border-color: deeppink':''}}"  >
                                @if ($errors->has('password_confirm'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                {{ $errors->first('password_confirm') }}

                                            </span>
                                @endif

                            </div>
                        </div>

                        <div class = "form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Rođenje:*') }}</label>
                            <div class="col-md-6">
                                <input id="date" type="date" name = "birth_date"  style = "{{$errors->has('birth_date')?'border-color: deeppink':''}}" class = "form-control">
                                @if ($errors->has('birth_date'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>


                        <div class = "form-group row" >
                            <label for="picture" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Profilna fotografija: ') }}</label>
                            <br>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td>

                                            <input id="picture" name = "picture" type="file" class = "form-control input-file"  value="{{ Request::old('picture') }}" style = "display: none;">
                                            <img src = "{{asset('img/default_content.png')}}" id = "img" class = "img" style = "width: 140px; height: 150px; background-color: #2B2C30">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type = "button" name = "browse_file" id = "browse_file" class = "btn btn-transparent form-control"  value = "Dodaj fotografiju">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                    </div>
                    <center>
                    <div class="form-group row mb-0 ">
                        <button type="submit" class="btn btn-transparent">
                            {{ __('Register') }}
                        </button>
                    </div>
                    </center>
                </form>
                <p> Polja koja pored naziva imaju * su obavezna! </p>


            </div>

        <br> <br> <br> <br>user
    </div>




@endsection
