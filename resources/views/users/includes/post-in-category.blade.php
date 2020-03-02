@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="col-md-6 article-card card-lg">
    <a href="{{$post->link}}" class="article-img mb-3 lg-img">
        <img src="{{$post->thumbnail}}" alt="name-article">
    </a>
    <a href="{{$post->link}}" class="article-title title-nowrap mb-2">{{$post->title}}</a>
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="date-info bottom-line d-flex align-items-center">
            {{$post->date_dots}} <a href="" class="profile-link title-nowrap">{{$post->author->name}}</a>
        </div>
        <copy-button link="{{$post->link}}"></copy-button>
    </div>
    <div class="article-short-text title-line-cap">{!! $post->excerpt !!}</div>
    <div class="article-button-action mt-3 position-relative">
        <div class="d-inline-flex">
            <likes :post_id="{{$post->id}}"
                   :initial_likes="{{$post->likes_count}}"
                   :initial_dislikes="{{$post->dislikes_count}}"
                   current_like="{{$post->currentLike}}">
            </likes>
            <button class="button btn-silver-light dropdown-toggle btn-comment"
                    @if($post->has_comments)data-toggle="dropdown"@endif>
                <i
                    class="far fa-comment-alt"></i>
                @if($post->has_comments)
                    <span class="badge-counter">{{$post->comments_count}}</span>
                @endif
            </button>
            <a href="{{$post->link}}/#comments" class="button btn-silver-light dropdown-toggle btn-comment-link">
                <i class="far fa-comment-alt"></i>
                @if($post->has_comments)
                    <span class="badge-counter">{{$post->comments_count}}</span>
                @endif
            </a>
            @include('posts.includes.comments')
        </div>
        @include('posts.includes.share')
    </div>
</div>
