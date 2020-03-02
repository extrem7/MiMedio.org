@php
    /*  @var $posts \Illuminate\Support\Collection */
@endphp

@extends('layouts.app')

@section('content')
    @include('users.includes.header')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="row inline-blocks">
                @foreach($posts as $post)
                    @include('users.includes.post-in-category')
                @endforeach
            </div>
            {!!$posts->linksUri!!}
        </div>
        @include('users.includes.sidebar')
    </div>
@endsection
