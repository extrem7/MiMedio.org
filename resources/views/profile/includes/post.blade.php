@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="col-md-6 article-column-card">
    <div class="left-column">
        <a href="{{$post->link}}" class="article-img">
            <img src="{{$post->image->getUrl()}}" alt="name-article">
        </a>
        <div class="article-button-action">
            <div class="d-inline-flex">
                <button class="button btn-silver-light dropdown-toggle btn-comment"
                        @if($post->has_comments)data-toggle="dropdown"@endif>
                    <i class="far fa-comment-alt"></i>
                    @if($post->has_comments)
                        <span class="badge-counter">{{$post->comments_count}}</span>
                    @endif
                </button>
                <a href="{{$post->link}}/#comments"
                   class="button btn-silver-light dropdown-toggle btn-comment-link">
                    <i class="far fa-comment-alt"></i>
                    @if($post->has_comments)
                        <span class="badge-counter">{{$post->comments_count}}</span>
                    @endif
                </a>
                @if($post->has_comments)
                    <div class="dropdown-menu dropdown-last-comment">
                        <div class="semi-bold blue-color mb-2">Last Comments</div>
                        <div class="last-comment">
                            @foreach($post->last_comments as $comment)
                                <div class="last-comment-item">
                                    <div class="d-flex align-items-center">
                                        <div class="name title-nowrap">{{$comment->author->name}}</div>
                                        <div class="date">{{$comment->date}}</div>
                                    </div>
                                    <div class="text-comment mt-1 title-line-cap">{{$comment->text}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="btn-group">
                    <button class="button btn-silver-light extra-bold dropdown-toggle"
                            data-toggle="dropdown">Mi
                    </button>
                    <div class="dropdown-menu dropdown-light">
                        <a href="" class="">Share in My Feed</a>
                        <a href="" class="">Share in Message</a>
                    </div>
                    <button class="button btn-silver-light"><i class="fab fa-twitter"></i></button>
                    <button class="button btn-silver-light"><i class="fab fa-facebook-f"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="right-column">
        <div class="d-flex align-items-start">
            <a href="{{$post->link}}" class="article-title title-line-cap mb-2">{{$post->title}}</a>
            <a href="{{route('posts.edit',$post->id)}}" class="icon blue-color edit-post-btn">
                <i class="fas fa-edit"></i>
            </a>
        </div>
        <div class="date-info bottom-line d-flex align-items-center mb-2">
            {{$post->date_dots}} <a href="" class="profile-link title-nowrap">{{$post->author->name}}</a>
        </div>
        <div class="article-short-text title-line-cap">{!! $post->excerpt !!}</div>
    </div>
</div>
