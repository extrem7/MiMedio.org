@extends('layouts.app')

@section('content')
    <div class="sign-form mx-auto">
        <div class="header-form">
            <div class="medium-size">@lang('mimedio.auth.reset.title')</div>
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
                               placeholder="@lang('mimedio.auth.forms.email')" autofocus>

                        @include('includes.field-error',['error'=>'email'])
                    </div>
                    <div class="form-group">
                        <button
                            class="button btn-blue shadow-none w-100 b-lg-base">@lang('mimedio.auth.reset.send')</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
