@extends('layouts.app')

@section('content')
    <div class="sign-form mx-auto">
        <div class="header-form">
            <div class="medium-size">{{ __('Reset Password') }}</div>
        </div>
        <div class="body-form">
            @if(session('status'))
                <p class="mb-0 text-center">{{session('status')}}</p>
            @else
                <form action="{{ route('password.email') }}" method="post"
                      class="{{$errors->isEmpty()?:'was-validated'}}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}" required autocomplete="email"
                               placeholder="{{ __('E-Mail Address') }}" autofocus>

                        @include('includes.field-error',['error'=>'email'])
                    </div>
                    <div class="form-group">
                        <button
                            class="button btn-blue shadow-none w-100 b-lg-base">{{ __('Send Password Reset Link') }}</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
