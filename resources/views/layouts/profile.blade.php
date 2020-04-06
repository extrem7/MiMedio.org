@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center mb-3">
        <ul class="category-tab-list horizontal-scroll horizontal-overflow">
            <li><a href="{{route('settings')}}" class="{{ Nav::isRoute('settings') }}">Profile</a></li>
            <li><a href="{{route('settings.channel')}}" class="{{ Nav::isRoute('settings.channel') }}">Channel</a></li>
            <li><a href="{{route('profile.posts.index')}}" class="{{ Nav::urlDoesContain('posts') }}">Posts</a></li>
            <li><a href="{{route('settings.playlist')}}" class="{{ Nav::isRoute('settings.playlist') }}">Playlist</a></li>
            <li><a href="{{route('poll')}}" class="{{ Nav::isRoute('poll') }}">Poll</a></li>
        </ul>
    </div>
    @yield('sub-content')
@endsection
