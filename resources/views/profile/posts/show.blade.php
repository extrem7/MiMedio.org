@php
    /* @var $post App\Models\Post
    *
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
                           :initial_likes="{{$post->likes}}"
                           :initial_dislikes="{{$post->dislikes}}"
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
            <div class="comment">
                <div class="box-shadow-content">
                    <div class="title-dark semi-bold">5 comments</div>
                </div>
                <div class="box-rounded up-to-top border-top-0 pt-0">
                    <ul class="comment-list">
                        <li class="">
                            <div class="d-flex comment-item">
                                <img src="assets/img/post.png" alt="" class="avatar">
                                <div>
                                    <div class="d-flex align-items-start align-items-sm-center flex-column flex-sm-row">
                                        <div class="name">Gerry robins</div>
                                        <div class="date ml-0 ml-sm-2 mb-2 mb-sm-0">8 days ago</div>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, cu viderer deseruisse sea, ne ridens euripidis quo.
                                        No nec regione ornatus fabellas, id case erroribus quo.
                                    </div>
                                    <div class="mt-2 d-flex align-items-center">
                                        <button class="icon"><i class="far fa-thumbs-up text-success"></i> 2</button>
                                        <button class="icon ml-2"><i class="far fa-thumbs-down text-danger"></i> 3
                                        </button>
                                        <button class="blue-color text-uppercase extra-small-size ml-2 icon">REPLY
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="comment-list">
                                <li class="">
                                    <div class="d-flex comment-item">
                                        <img src="assets/img/post.png" alt="" class="avatar">
                                        <div>
                                            <div
                                                class="d-flex align-items-start align-items-sm-center flex-column flex-sm-row">
                                                <div class="name">Gerry robins</div>
                                                <div class="date ml-0 ml-sm-2 mb-2 mb-sm-0">8 days ago</div>
                                            </div>
                                            <div>Lorem ipsum dolor sit amet, cu viderer deseruisse sea, ne ridens
                                                euripidis quo.
                                                No nec regione ornatus fabellas, id case erroribus quo.
                                            </div>
                                            <div class="mt-2 d-flex align-items-center">
                                                <button class="icon"><i class="far fa-thumbs-up text-success"></i>
                                                </button>
                                                <button class="icon ml-2"><i class="far fa-thumbs-down text-danger"></i>
                                                </button>
                                                <button class="blue-color text-uppercase extra-small-size ml-2 icon">
                                                    REPLY
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="submit-comment">
                        <textarea name="" id="" cols="2" class="control-form"></textarea>
                        <button class="button btn-blue"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="video-channel mb-4">
                <div class="channel-name title-nowrap">El Ciudadano TV (ECTV)</div>
                <div class="channel-main-video">
                    <iframe src="https://www.youtube.com/embed/KLLe7N9453s" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
                <div class="channel-play-box">
                    <div class="play-btn"><i class="fas fa-play"></i></div>
                    <div class="video-name">LiberaLibro - POGO</div>
                    <div class="time">22:22</div>
                </div>
                <div class="channel-video-list">
                    <div class="video-item">
                        <img src="https://img.youtube.com/vi/YRhSjA31mmA/default.jpg" alt="">
                        <div>
                            <div class="video-name title-line-cap">LiberaLibro - POGO</div>
                            <div class="time">22:22</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="box-rounded similar">
                <div class="blue-color semi-bold medium-size">Similar articles</div>
                <div class="row inline-blocks">
                    <div class="article-mini-card col-lg-4">
                        <div class="left-column">
                            <a href="" class="article-img">
                                <img
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                    alt="name-article">
                            </a>
                        </div>
                        <div class="right-column">
                            <div class="box-date">29.12.2019</div>
                            <a href="" class="article-title title-line-cap">Fiscalía formalizará a ex comandante en jefe
                                del Ejército por lavado de activos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
