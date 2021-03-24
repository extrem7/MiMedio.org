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
                <h1 class="post-name">{{$post['title']}}</h1>
                <div class="box-shadow-content channel-info-box mt-3">
                    <div class="item">
                        <i class="fas fa-calendar-alt mr-2"></i> {{$post['date']}}
                    </div>
                </div>
                @if($post['image'])
                    <div class="post-img">
                        <img src="{{$post['image']}}" class="img-fluid" alt="{{$post['title']}}">
                    </div>
                @endif
                <div class="dynamic-content">{!! $post['body'] !!}</div>
            </article>
        </div>
    </div>
@endsection
