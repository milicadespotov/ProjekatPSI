@extends('layouts.master')

@section('content')
    <div class = "backgroundLoginI">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><h3 style = "color: #8e2985"> {{ __('Napravite svoj nalog i postanite deo galaksije pravih zaljubljenika u serije!') }} </h3></div>
                        <br> <br> <br>
                        <div class="card-body">
                            <form method="POST" enctype= "multipart/form-data" class = "contact-form fadeInUp color" data-wow-duration="500ms" data-wow-delay="300ms" action="{{ route('register') }}">
                                @csrf
                                <!-- User name REQUESTED WANT -->
                                <div class="form-group row">
                                    <label for = "username" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Korisničko ime:*') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" style = "{{$errors->has('username')?'border-color: pink': ''}}" name="username" value="{{ old('username') }}"  autofocus>

                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" style = "color: pink">
                                            {{ $errors->first('username') }}
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Name NOT REQUEST -->
                                 <div class="form-group row">
                                     <label for="name" class="col-md-4 col-form-label" style = "font-size: 18px"  text-md-right" style = "">{{ __('Ime: ') }}</label>
                                     <div class="col-md-6">
                                         <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" style = "{{$errors->has('name')?'border-color: pink':'' }}" autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" style = "color: pink">
                                                {{ $errors->first('name') }}
                                            </span>
                                             @endif
                                         </div>
                                 </div>
                                  <div class="form-group row">
                                        <label for="surname" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Prezime: ') }}</label>

                                        <div class="col-md-6">
                                            <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname"  value="{{ old('surname') }}"   style = "{{$errors->has('surname')?'border-color: pink':''}}" autofocus>
                                            @if ($errors->has('surname'))
                                                <span class="invalid-feedback" style = "color: pink">
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
                                            <span class="invalid-feedback" style = "color: pink">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for = "security_question" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Bezbednosno pitanje: *') }}</label>

                                    <div class="col-md-6">
                                        <input id="security_question" type="text" class="form-control{{ $errors->has('security_question') ? ' is-invalid' : '' }}" name="security_question" value="{{ old('security_question') }}"   style = "{{$errors->has('surname')?'border-color: pink':''}}"  autofocus>

                                        @if ($errors->has('security_question'))
                                            <span class="invalid-feedback" style = "color: pink">
                                                {{ $errors->first('security_question') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for = "answer" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Odgovor: *') }}</label>

                                    <div class="col-md-6">
                                        <input id="answer" type="text" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" value="{{ old('answer') }}"  autofocus>

                                        @if ($errors->has('answer'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('answer') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('E-Mail Adresa: *') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;" >{{ __('Lozinka: *') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Loznka Ponovljena: *') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirm" >
                                    </div>
                                </div>

                                <div class = "form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Rođenje: *') }}</label>
                                    <div class="col-md-6">
                                        <input id="date" type="date" name = "birth_date" class = "form-control">

                                    </div>
                                </div>


                                <div class = "form-group row">
                                    <label for="picture" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Profilna fotografija: ') }}</label>
                                    <div class="col-md-6">
                                        <input id="picture" name = "picture" type="file" class = "form-control input-file"  value="{{ Request::old('picture') }}">

                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-transparent">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
