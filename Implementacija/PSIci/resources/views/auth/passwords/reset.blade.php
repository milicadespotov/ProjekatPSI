@extends('layouts.master')

@section('content')
    <div class = "backgroundLogin" style="width:100%">
<div class="container-fluid" style="width:100%"> <br> <br> <br> <br> <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h3> {{ __('Resetovanje lozinke: ') }} </h3></div>
                <br> <br> <br>
                <div class="card-body">
                    <form method="POST" action="{{ route('password_reset_confirm') }}"  class = "contact-form fadeInUp color"  data-wow-duration="500ms" data-wow-delay="300ms">
                        @csrf



                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px;">{{ __('Lozinka stara:') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" style = "{{ $errors->has('old_password') ? 'deeppink' : '' }}" name="old_password"  autofocus>

                                @if ($errors->has('old_password'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right " style = "font-size: 18px;">{{ __('Nova lozinka: ') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  style =  "{{$errors->has('password')?'border-color: deeppink':''}}"name="password"  >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style = "color: deeppink">
                                        <strong>{{ $errors->first('password') }}</strong>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-transparent">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>  <br>
        <br>
    </div>
@endsection
