@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="article-column-card {{$class??''}}">
    <div class="left-column">
        <a href="{{$post->link}}" class="article-img">
            <img src="{{$post->thumbnail}}" alt="name-article">
        </a>
        <div class="article-button-action">
            <div class="d-inline-flex">
                @if(isset($showComments))
                    <button class="button btn-silver-light dropdown-toggle btn-comment"
                            @if($post->has_comments)data-toggle="dropdown"@endif>
                        <i class="far fa-comment-alt"></i>
                        @if($post->has_comments)
                            <span class="badge-counter">{{$post->comments_count}}</span>
                        @endif
                    </button>
                @endif
                <a href="{{$post->link}}/#comments"
                   class="button btn-silver-light dropdown-toggle btn-comment-link">
                    <i class="far fa-comment-alt"></i>
                    @if($post->has_comments)
                        <span class="badge-counter">{{$post->comments_count}}</span>
                    @endif
                </a>
                @if(isset($showComments))
                    @include('posts.includes.comments')
                @endif
                @include('posts.includes.share',['hide_text'=>true])
            </div>
        </div>
    </div>
    <div class="right-column">
        <div class="d-flex align-items-start">
            <a href="{{$post->link}}" class="article-title title-line-cap mb-2">{{$post->title}}</a>
            @if(isset($edit))
                <a href="{{route('posts.edit',$post->id)}}" class="icon blue-color edit-post-btn ml-2">
                    <i class="fas fa-edit"></i>
                </a>
            @endif
            @if(isset($edit))
                <form action="{{route('posts.destroy',$post->id)}}" method="post" class="ml-2">
                    @method('DELETE')
                    @csrf
                    <button class="icon edit-post-btn"><i class="fas fa-trash-alt"></i></button>
                </form>
            @endif
        </div>
        <div class="date-info bottom-line d-flex align-items-center mb-2">
            {{$post->date_dots}}
            @if(!isset($hideAuthor))
                <a href="{{$post->author->link}}" class="profile-link title-nowrap">{{$post->author->name}}</a>
            @else
                <div class="item ml-2"><i class="far fa-eye mr-1"></i>{{$post->views}}</div>
            @endif
        </div>
        <div class="article-short-text title-line-cap">{!! $post->excerpt !!}</div>
    </div>
</div>
