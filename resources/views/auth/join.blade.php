@extends('layouts.app')
@section('content')
    <div class="login-form mx-auto">
        <div class="header-form">
            Join With Us!
        </div>
        <div class="body-form">
            <div class="d-flex align-items-center justify-content-center">
                <a href="{{route('register')}}" class="button btn-silver">{{ __('Register') }}</a>
                <a href="{{route('login')}}" class="button btn-silver ml-1">{{ __('Login') }}</a>
            </div>
            <!-- todo terms -->
            <div class="text-muted text-center mt-3">* I agree with a <a href="" class="link text-decoration-none">Terms
                    & Conditions</a></div>
        </div>
    </div>
    <div class="mt-5 mx-auto">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item"
                    src="https://www.youtube.com/embed/{{get_option('join_video')}}"></iframe>
        </div>
    </div>
@endsection
