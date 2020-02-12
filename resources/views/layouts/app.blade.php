<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    @meta_tags
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <style>
        :root {
            --chanelColor: red;
        }
    </style>
    @stack('styles')
</head>
<body class="@yield('body-class')">
<div id="app">
    @include('includes.header')
    <main class="content container">
        @yield('content')
    </main>
    @include('includes.footer')
</div>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
@stack('scripts')
</body>
</html>
