@extends('layouts.master')

@section('content')
 <div class = "backgroundLogin">
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style = "margin-top: 40px;">
                <div class="card-header color" > <h1> {{ __('Jednu prijavu ste daleko od galaksije serija: ') }} </h1> </div>
                <br> <br>  <br>
                <div class="card-body" style = "margin-top: 40px;">
                    <form method="POST" action="{{ route('login') }}" class = "contact-form fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" style = "font-size: 18px" class="col-sm-4 col-form-label text-md-right color">{{ __('Username: ') }}</label>

                            <div class="col-md-6">
                                <input id="username"  placeholder="unesite korisniko ime" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" style = "border-color: {{ $errors->has('username') ? 'deeppink' : '' }}" autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" style ="color: deeppink">
                                        {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right color" style = "font-size: 18px;">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder =  "unesite lozinku" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox color">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <div class = "cf-submit">
                                    <button type="submit" class="btn btn-transparent">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                                <div class = "">
                                        <a class="btn replay" href="{{ route('password_request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br> <br> <br> <br> <br> <br> <br> <br> <br>  <br>

</div>
</div>

@endsection
