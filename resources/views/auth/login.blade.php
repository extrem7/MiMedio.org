@extends('layouts.app')
@section('content')
    <div class="sign-form mx-auto">
        <div class="header-form">
            <div class="medium-size">{{ __('Login') }}</div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="body-form {{was_validated($errors)}}">
            @csrf

            <div class="form-group">
                <input id="email" type="email"
                       class="form-control {{valid_class('email',$errors)}}" name="email"
                       value="{{ old('email') }}" required autocomplete="email"
                       placeholder="{{ __('E-Mail Address') }}" autofocus>
                @include('includes.field-error',['error'=>'email'])
            </div>
            <div class="form-group">
                <input id="password" type="password"
                       class="form-control {{valid_class('password',$errors)}}" name="password"
                       required placeholder="{{ __('Password') }}" autocomplete="current-password">
                @include('includes.field-error',['error'=>'password'])
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label blue-color" for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <div class="form-group">
                <button class="button btn-blue shadow-none w-100 b-lg-base btn-transform"> {{ __('Login') }}</button>
            </div>
            <div class="form-group">
                <a href="{{ route('password.request') }}"
                   class="link text-decoration-none"> {{ __('Forgot Your Password?') }}</a>
            </div>
            @include('auth.includes.socialite')
            <p class="text-center mb-2">Don't Have an Account?</p>
            <div class="d-flex align-items-center justify-content-center">
                <a href="{{route('register')}}" class="button btn-silver mx-164">{{ __('Register') }}</a>
            </div>
        </form>
    </div>
@endsection
