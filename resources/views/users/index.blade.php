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
    <div class="row inline-blocks">
        @foreach($users as $channel)
            @include('users.includes.channel')
        @endforeach
    </div>
    {!!$users->linksUri!!}
@endsection

