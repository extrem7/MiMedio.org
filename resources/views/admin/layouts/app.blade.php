<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | AdminMiMedio</title>
    <link rel="stylesheet" href="{{asset('admin/css/pace.css')}}">
    <script src="{{asset('admin/js/pace.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @stack('styles')
</head>
<body class="hold-transition @yield('body-class')">
@yield('main')
<script src="{{asset('admin/js/main.js')}}"></script>
@stack('scripts')
</body>
</html>
