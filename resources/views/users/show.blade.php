@php
    /* @var $user App\Models\User
    * @var $posts \Illuminate\Support\Collection
    * @var $categories App\Models\Category[]
    */
@endphp

@extends('layouts.app')

@include('users.includes.custom-color')
@section('content')
    @include('users.includes.header')
    <div class="row">
        <div class="col-lg-8 col-12 my-own-media">
            @if($posts->isNotEmpty())
                <div class="box-rounded main-media">
                    <div class="row">
                        <div class="col-md-6">
                            @php
                                $post = $posts->shift();
                            @endphp
                            @include('users.includes.post-large',compact('post'))
                        </div>
                        <posts-vertical-list
                            :initial_posts="{{json_encode($posts)}}"
                            :user_id="{{$user->id}}"></posts-vertical-list>
                    </div>
                </div>
            @endif
            @include('users.includes.social')
            <shared-list></shared-list>
            <categories-list></categories-list>
            <rss-feeds-list></rss-feeds-list>
        </div>
        @include('users.includes.sidebar')
    </div>
@endsection
@push('scripts')
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v6.0&appId=2267874190154020&autoLogAppEvents=1"></script>
    <script async defer src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script async defer src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
@endpush
