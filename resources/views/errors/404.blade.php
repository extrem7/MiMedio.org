@extends('layouts.app')
@section('content')
    <div class="error-page d-flex align-items-center">
        <div class="error-box d-flex align-items-center justify-content-center">
            <div class="blue-color title-error">404</div>
        </div>
        <div class="ml-25 error-text">
            <div class="large-size blue-color">@lang('mimedio.404.title')</div>
            <div class="mt-2">
                @lang('mimedio.404.text') <br> <a href="{{route('home')}}" class="link">@lang('mimedio.404.home')</a>
            </div>
            <div class="mt-2">@lang('mimedio.404.description')</div>
        </div>
    </div>
@endsection
