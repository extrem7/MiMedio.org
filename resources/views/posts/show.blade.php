@php
    /* @var $post App\Models\Post */
@endphp

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <article class="post">
                <h1 class="post-name">{{$post->title}}</h1>
                <div class="box-shadow-content channel-info-box mt-3">
                    <div class="item">
                        <a href="" class="profile-box">
                            <img src="{{$post->author->getAvatar('icon')}}" alt="name-article">
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
                        <img src="{{$post->image->getUrl()}}" class="img-fluid" alt="{{$post->title}}">
                    </div>
                @endif
                <div class="article-button-action mt-3 mb-3 position-relative">
                    <likes :post_id="{{$post->id}}"
                           :initial_likes="{{$post->likes_count}}"
                           :initial_dislikes="{{$post->dislikes_count}}"
                           current_like="{{$post->currentLike}}">
                    </likes>
                    <div class="d-flex align-items-center">
                        <div class="text-muted ml-15 mr-2">Share:</div>
                        <div class="btn-group">
                            <button class="button btn-silver-light extra-bold dropdown-toggle" data-toggle="dropdown">
                                Mi
                            </button>
                            <div class="dropdown-menu dropdown-light">
                                <a href="" class="">Share in My Feed</a>
                                <a href="" class="">Share in Message</a>
                            </div>
                            <button class="button btn-silver-light"><i class="fab fa-twitter"></i></button>
                            <button class="button btn-silver-light"><i class="fab fa-facebook-f"></i></button>
                        </div>
                    </div>
                </div>
                <div class="dynamic-content">{!! $post->body !!}</div>
            </article>
            <div id="comments">
                <comments :post_id="{{$post->id}}" :initial_comments="{{$post->comments}}"
                          :initial_count="{{$post->comments_count}}"></comments>
            </div>
        </div>
        @if($playlist)
            <div class="col-lg-4">
                @include('posts.includes.playlist')
            </div>
        @endif
        @if($post->related->count())
            <div class="col-12">
                <div class="box-rounded similar">
                    <div class="blue-color semi-bold medium-size">Similar articles</div>
                    <div class="row inline-blocks">
                        @foreach($post->related as $post)
                            @include('posts.includes.related')
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
