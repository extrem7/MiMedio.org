@extends('layouts.app')
@section('content')
    <div class="login-form mx-auto">
        <div class="header-form">@lang('mimedio.auth.join.title')</div>
        <div class="body-form">
            <div class="d-flex align-items-center justify-content-center">
                <a href="{{route('register')}}" class="button btn-silver">@lang('mimedio.auth.register')</a>
                <a href="{{route('login')}}" class="button btn-silver ml-1">@lang('mimedio.auth.login')</a>
            </div>
            <!-- todo terms -->
            <div class="text-muted text-center mt-3">* @lang('mimedio.auth.join.agree')
                <a href="" class="link text-decoration-none">@lang('mimedio.auth.join.terms')</a></div>
        </div>
    </div>
    <div class="mt-5 mx-auto">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item"
                    src="https://www.youtube.com/embed/{{get_option('join_video')}}"></iframe>
        </div>
    </div>
@endsection
