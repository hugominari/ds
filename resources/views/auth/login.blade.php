@extends('layouts.app')

@section('content')
    
    
    {!! Form::open(['route' => 'login', 'method' => 'POST', 'class' => 'ajax-form']) !!}
    <!-- Main navigation -->
    <header class="">
        <!-- Full Page Intro -->
        <div class="" style="background-image: url({{ asset('img/background.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask d-flex justify-content-center align-items-center pb-5 pt-2">
                <!-- Content -->
                <div class="container pb-5">
                    <!--Grid row-->
                    <div class="row pt-lg-5 mt-lg-5">
                       
                        <!--Grid column-->
                        <div class="col-md-6 offset-md-3 mb-4">
                            <!--Form-->
                            <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                <div class="card-body z-depth-2">
                                    <!--Header-->
                                    <div class="text-center">
                                        <h3 class="dark-grey-text">
                                            <strong>Painel Administrativo</strong>
                                        </h3>
                                        <hr>
                                    </div>
                                    <!--Body-->
                                    {{ Form::cText('username', '', 'Nome de Usuário') }}
                                    {{ Form::cPassword('password', '', 'Senha') }}
                                    {{ Form::cCheckbox('remember', '1', 'Lembrar-me') }}
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="btn-login" type="submit" class="btn btn-primary float-right">
                                                {{ __('Entrar') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.Form-->
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </div>
                <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
        </div>
        <!-- Full Page Intro -->
    </header>
    <!-- Main navigation -->
    {!! Form::close() !!}
    
    
    
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Nome de Usuário') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>--}}

                                {{--@if ($errors->has('username'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                        {{--{{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-8 offset-md-4">--}}
                                {{--<button id="btn-login" type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Login') }}--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--{{ __('Forgot Your Password?') }}--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
