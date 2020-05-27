@extends('layouts.app')

@section('content')
    <div class="sign-form mx-auto">
        <div class="header-form">
            <div class="medium-size">@lang('mimedio.auth.register')</div>
        </div>
        <form method="POST" action="{{ route('register') }}" class="body-form {{was_validated($errors)}}">
            @csrf

            <div class="form-group">
                <input id="name" type="text"
                       class="form-control {{valid_class('name',$errors)}}" name="name"
                       value="{{ old('name') }}" required autocomplete="name" placeholder="@lang('mimedio.auth.forms.name')" autofocus>
                @include('includes.field-error',['error'=>'name'])
            </div>
            <div class="form-group">
                <input id="email" type="email"
                       class="form-control {{valid_class('email',$errors)}}" name="email"
                       value="{{ old('email') }}" required placeholder="@lang('mimedio.auth.forms.email')"
                       autocomplete="email">
                @include('includes.field-error',['error'=>'email'])
            </div>
            <div class="form-group">
                <input id="password" type="password"
                       class="form-control {{valid_class('password',$errors)}}" name="password"
                       required placeholder="@lang('mimedio.auth.forms.password')" autocomplete="new-password">
                @include('includes.field-error',['error'=>'password'])
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" placeholder="@lang('mimedio.auth.forms.password_confirm')" required
                       autocomplete="new-password">
            </div>
            <div class="form-group">
                <button class="button btn-blue shadow-none w-100 b-lg-base">@lang('mimedio.auth.register')</button>
            </div>
            @include('auth.includes.socialite')
            <p class="text-center mb-2">@lang('mimedio.auth.already_have_account')</p>
            <div class="d-flex align-items-center justify-content-center">
                <a href="{{route('login')}}" class="button btn-silver ml-1 mx-164">@lang('mimedio.auth.login')</a>
            </div>
        </form>
    </div>
@endsection
