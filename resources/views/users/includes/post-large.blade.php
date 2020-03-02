@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="article-card card-lg">
    <a href="{{$post->link}}" class="article-img mb-3 lg-img">
        <img src="{{$post->thumbnail}}" alt="{{$post->title}}">
    </a>
    <a href="{{$post->link}}" class="article-title title-nowrap mb-2">{{$post->title}}</a>
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="date-info bottom-line d-flex align-items-center">{{$post->date_dots}}</div>
    </div>
    <div class="article-short-text title-line-cap">{!! $post->excerpt !!}</div>
</div>
