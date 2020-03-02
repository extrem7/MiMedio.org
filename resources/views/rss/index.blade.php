@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')
    <div class="row article-collapse-list inline-blocks">
        @foreach($items as $item)
            <div class="col-md-6 col-lg-4 collapse-card">
                <div class="article-collapse" id="article-collapse-{{$item->id}}">
                    <div class="box-shadow-content channel-box">
                        <a href="{{$item->link}}" target="_blank" class="channel-img">
                            <img src="{{$item->image}}" alt="chanel logo">
                        </a>
                        <!--<a href="" class="title-dark medium-bold small">Delete</a>-->
                    </div>
                    @foreach($item->posts as $post)
                        <div class="collapse-item">
                            <div class="box-shadow-content">
                                <div class="d-flex">
                                    <div class="collapse-button collapsed" role="button" data-toggle="collapse"
                                         data-target="#article-{{$post->id}}" aria-expanded="true"></div>
                                    <div class="collapse-wrapper">
                                        <a href="{{$post->link}}" target="_blank"
                                           class="article-title title-line-cap">{{$post->title}}</a>
                                    </div>
                                    <div
                                        class="title-dark extra-small-size date">{{Carbon::parse($post->date)->format('h:s')}}</div>
                                </div>
                            </div>
                            <div id="article-{{$post->id}}" class="collapse"
                                 data-parent="#article-collapse-{{$item->id}}">
                                <div class="box-rounded border-top-0">
                                    <div class="box-date mb-2">{{Carbon::parse($post->date)->format('Y.m.d')}}</div>
                                    <div class="article-short-text title-line-cap">{{$post->excerpt}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{route('rss.add',$item->id)}}"
                       class="button btn-blue btn-transform b-lg w-100 semi-bold shadow-none mt-2">Add to My Media</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
