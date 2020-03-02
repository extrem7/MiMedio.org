@php
    /* @var $post App\Models\Post
     * @var $related App\Models\Post[]
     */
@endphp

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <article class="post">
                <h1 class="post-name">{{$post->title}}</h1>
                <div class="box-shadow-content channel-info-box mt-3">
                    <div class="item">
                        <a href="{{route('users.show',$post->author->id)}}" class="profile-box">
                            <img src="{{$post->author->avatar}}" alt="name-article">
                            <div class="name title-nowrap">{{$post->author->name}}</div>
                        </a>
                    </div>
                    <div class="item">
                        <i class="fas fa-calendar-alt mr-2"></i> {{$post->date}}
                    </div>
                    <div class="item"><i class="far fa-eye mr-1"></i>{{$post->views}}</div>
                </div>
                @if($post->image)
                    <div class="post-img">
                        <img src="{{$post->thumbnail}}" class="img-fluid" alt="{{$post->title}}">
                    </div>
                @endif
                <div class="article-button-action mt-3 mb-3 position-relative">
                    <likes :post_id="{{$post->id}}"
                           :initial_likes="{{$post->likes_count}}"
                           :initial_dislikes="{{$post->dislikes_count}}"
                           current_like="{{$post->currentLike}}">
                    </likes>
                    @include('posts.includes.share')
                </div>
                <div class="dynamic-content">{!! $post->body !!}</div>
            </article>
            <div id="comments">
                <comments :post_id="{{$post->id}}"></comments>
            </div>
        </div>
        @if($playlist)
            <div class="col-lg-4">
                @include('posts.includes.playlist')
            </div>
        @endif
        @if($related->count())
            <div class="col-12">
                <div class="box-rounded similar">
                    <div class="blue-color semi-bold medium-size">Similar articles</div>
                    <div class="row inline-blocks">
                        @foreach($related as $post)
                            @include('posts.includes.related')
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
