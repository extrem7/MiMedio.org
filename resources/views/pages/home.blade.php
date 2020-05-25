@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <a href="{{route(Auth::check()?'posts.create':'join')}}"
               class="button btn-yellow w-100 mb-4 btn-transform">Create the new post</a>
            <posts-home-list></posts-home-list>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-5 mt-md-0">
            <a href="{{route('rss')}}" class="button btn-blue btn-transform w-100 mb-4">Add news channel</a>
            @foreach($rss as $item)
                @include('rss.includes.item',['home'=>true])
            @endforeach
        </div>
        <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-12">
                    @auth
                        @include('pages.includes.followings')
                    @endauth
                    @include('posts.includes.playlist')
                </div>
                @auth
                    <div class="col-lg-12 col-md-6 col-12">
                        @include('pages.includes.chat')
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
