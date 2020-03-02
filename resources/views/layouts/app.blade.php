<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @meta_tags
    <link rel="stylesheet" href="{{mix('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{mix('assets/css/main.css')}}">
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
    <error></error>
</div>
@shared
<script src="{{mix('assets/js/main.js')}}"></script>
<script src="{{mix('assets/js/app.js')}}"></script>
@stack('scripts')
</body>
</html>
