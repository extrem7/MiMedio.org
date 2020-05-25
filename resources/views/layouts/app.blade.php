<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @meta_tags
    <link rel="stylesheet" href="{{mix('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{mix('assets/css/main.css')}}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
<div id="fb-root"></div>
<div id="app">
    @include('includes.header')
    <main class="content container">
        @yield('content')
    </main>
    @include('includes.footer')
    <comments-modal></comments-modal>
    <alert></alert>
    @auth
        <mi-chat-notifications v-if="!route().current('messenger')"></mi-chat-notifications>
        <mi-share-modal></mi-share-modal>
    @endauth
</div>
@shared
@routes
<script src="{{mix('assets/js/main.js')}}"></script>
<script src="{{mix('assets/js/app.js')}}"></script>
@stack('scripts')
</body>
</html>
