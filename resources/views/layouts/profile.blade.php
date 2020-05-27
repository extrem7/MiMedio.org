@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center mb-3">
        <ul class="category-tab-list horizontal-scroll horizontal-overflow">
            <li>
                <a href="{{route('settings.page')}}"
                   class="{{ Nav::isRoute('settings.page') }}">@lang('mimedio.profile.menu.profile')</a>
            </li>
            <li>
                <a href="{{route('settings.channel')}}"
                   class="{{ Nav::isRoute('settings.channel') }}">@lang('mimedio.profile.menu.channel')</a>
            </li>
            <li>
                <a href="{{route('profile.posts.index')}}"
                   class="{{ Nav::urlDoesContain('posts') }}">@lang('mimedio.profile.menu.posts')</a>
            </li>
            <li>
                <a href="{{route('settings.playlist')}}"
                   class="{{ Nav::isRoute('settings.playlist') }}">@lang('mimedio.profile.menu.playlist')</a>
            </li>
            <li>
                <a href="{{route('poll.page')}}"
                   class="{{ Nav::isRoute('poll.page') }}">@lang('mimedio.profile.menu.poll')</a>
            </li>
        </ul>
    </div>
    @yield('sub-content')
@endsection
