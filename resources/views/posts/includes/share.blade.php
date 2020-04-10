@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="d-flex align-items-center">
    @if(!isset($hide_text))
        <div class="text-muted ml-15 mr-2">Share:</div>
    @endif
    <div class="btn-group">
        <button class="button btn-silver-light extra-bold dropdown-toggle" data-toggle="dropdown">Mi</button>
        <div class="dropdown-menu dropdown-light">
           <share-button :post-id="{{$post->id}}"></share-button>
            <send-button link="{{$post->link}}"></send-button>
        </div>
        {!!share_buttons($post->link)!!}
    </div>
</div>
