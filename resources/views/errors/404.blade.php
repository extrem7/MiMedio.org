@extends('layouts.app')
@section('content')
    <div class="error-page d-flex align-items-center">
        <div class="error-box d-flex align-items-center justify-content-center">
            <div class="blue-color title-error">404</div>
        </div>
        <div class="ml-25 error-text">
            <div class="large-size blue-color">Page is not found</div>
            <div class="mt-2">
                change your search query
                or go to the <br> <a href="{{route('home')}}" class="link">home page</a>
            </div>
            <div class="mt-2">
                The URL or its content was either deleted
                or moved (without adjusting any internal l
                inks accordingly)
            </div>
        </div>
    </div>
@endsection
