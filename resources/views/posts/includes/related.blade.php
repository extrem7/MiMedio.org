@php
    /* @var $post App\Models\Post */
@endphp
<div class="article-mini-card col-lg-4">
    <div class="left-column">
        <a href="{{$post->link}}" class="article-img">
            <img src="{{$post->thumbnail}}" alt="{{$post->title}}">
        </a>
    </div>
    <div class="right-column">
        <div class="box-date">{{$post->date_dots}}</div>
        <a href="{{$post->link}}" class="article-title title-line-cap">{{$post->title}}</a>
    </div>
</div>
