@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="col-md-6 col-lg-4 article-card card-lg">
    <div class="box-shadow-content channel-info-box">
        <div class="item">
            <a href="{{$post->author->link}}" class="profile-box">
                <img src="{{$post->author->avatar}}" alt="name-article">
                <div class="name title-nowrap">{{$post->author->name}}</div>
            </a>
        </div>
        <div class="item"><i class="far fa-eye mr-1"></i>{{$post->views}}</div>
        <followers :user_id="{{$post->author->id}}"
                   :initial_followers="{{$post->author->followers_count??0}}"></followers>
        @if(!is_current_user($post->author))
            <follow-button :user_id="{{$post->author->id}}" :initial_following="{{is_following($post->author)}}">
            </follow-button>
        @endif
    </div>
    <div class="box-rounded up-to-top border-top-0">
        <a href="{{$post->link}}" class="article-img mb-3 md-img">
            <img src="{{$post->thumbnail}}" alt="{{$post->title}}">
        </a>
        <a href="{{$post->link}}" class="article-title title-nowrap mb-2">{{$post->title}}</a>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="date-info bottom-line d-flex align-items-center">
                {{$post->date_dots}} <a href="{{$post->author->link}}"
                                        class="profile-link title-nowrap">{{$post->author->name}}</a>
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
</div>
