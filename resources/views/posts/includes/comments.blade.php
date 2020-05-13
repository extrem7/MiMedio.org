@if($post->has_comments)
    <div class="dropdown-menu dropdown-last-comment">
        <div class="semi-bold blue-color mb-2">Last Comments</div>
        <div class="last-comment">
            @foreach($post->comments as $comment)
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
