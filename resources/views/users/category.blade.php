@php
    /*  @var $posts \Illuminate\Support\Collection */
@endphp

@extends('layouts.app')

@include('users.includes.custom-color')

@section('content')
    @include('users.includes.header')
    <div class="row">
        <user-category-list></user-category-list>
        @include('users.includes.sidebar')
    </div>
@endsection
