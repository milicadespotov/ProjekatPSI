@extends('layouts.master')

@section('content')
    <div class = "backgroundLoginI">
    <br> <br> <br> <br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style = "color: grey"><h3>{{ __('Resetovanje password') }}</h3></div> <br> <br> <br>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" class = " contact-form fadeInUp color"  data-wow-duration="500ms" data-wow-delay="300ms" action="{{ route('password_email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px ">{{ __('E-Mail: ') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }} " style = "{{$errors->has('email') ? 'border-color: pink' : ''}}" name="security_question" value="{{ old('security_question') }}"  required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style = "color: pink;">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="security_question" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Sigurnosno pitanje: ') }}</label>

                            <div class="col-md-6">
                                <input id="security_question" type="text" class="form-control{{ $errors->has('security_question') ? ' is-invalid' : '' }}" style = "{{$errors->has('security_question') ? 'border-color: pink' : ''}}" name="security_question" value="{{ old('security_question') }}" required>

                                @if ($errors->has('security_question'))
                                    <span class="invalid-feedback" style = "color:pink;">
                                        {{ $errors->first('security_question') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="answer" class="col-md-4 col-form-label text-md-right" style = "font-size: 18px">{{ __('Sigurnosno pitanje ') }}</label>

                            <div class="col-md-6">
                                <input id="answer" type="text" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" style = "{{$errors->has('answer')? 'border-color: pink' : ''}}" name="answer" required>

                                @if ($errors->has('answer'))
                                        <span class="invalid-feedback" style = "color:pink">
                                        {{ $errors->first('answer') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-transparent">
                                    {{ __('Posalji reset link') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    </div>

@endsection
