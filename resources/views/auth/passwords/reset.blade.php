@extends('layouts.app')

@section('content')
    <div class="sign-form mx-auto">
        <div class="header-form">
            <div class="medium-size">{{ __('Reset Password') }}</div>
        </div>
        <div class="body-form">
            <form action="{{ route('password.update') }}" method="post"
                  class="{{was_validated($errors)}}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <input id="email" type="email" class="form-control {{valid_class('email',$errors)}}"
                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                           placeholder="{{ __('E-Mail Address') }}"
                           autofocus>

                    @include('includes.field-error',['error'=>'email'])
                </div>

                <div class="form-group">
                    <input id="password" type="password"
                           class="form-control {{valid_class('password',$errors)}}" name="password" required
                           autocomplete="new-password" placeholder="{{ __('Password') }}">

                    @include('includes.field-error',['error'=>'password'])
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                </div>

                <div class="form-group">
                    <button
                        class="button btn-blue shadow-none w-100 b-lg-base">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
