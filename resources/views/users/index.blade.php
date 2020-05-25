@php
    /* @var $user App\Models\User
    * @var $users \Illuminate\Support\Collection
    */
@endphp

@extends('layouts.app')

@section('content')
    @auth
        <a href="{{route('posts.create')}}" class="mx-164 button btn-silver-light btn-transform mb-4">Create Post</a>
    @endauth
    <channels-list></channels-list>
@endsection

