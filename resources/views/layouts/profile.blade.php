@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center mb-3">
        <ul class="category-tab-list horizontal-scroll horizontal-overflow">
            <li><a href="{{route('settings')}}" class="dropdown-item {{ Nav::isRoute('settings') }}">Settings</a></li>
            <li><a href="{{route('profile.posts.index')}}" class="dropdown-item {{ Nav::urlDoesContain('posts') }}">Posts</a></li>
            <li><a href="{{route('settings.playlist')}}" class="dropdown-item {{ Nav::isRoute('settings.playlist') }}">Playlist</a></li>
            <!--<li><a href="">Votes</a></li>-->
        </ul>
    </div>
    @yield('sub-content')
@endsection
