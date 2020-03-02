@php
    /* @var $post Post
    */use App\Models\Post;
@endphp
<div class="d-flex align-items-center">
    <div class="text-muted ml-15 mr-2">Share:</div>
    <div class="btn-group">
        <button class="button btn-silver-light extra-bold dropdown-toggle" data-toggle="dropdown">Mi</button>
        <div class="dropdown-menu dropdown-light">
            <a href="" class="">Share in My Feed</a>
            <a href="" class="">Share in Message</a>
        </div>
        {!!share_buttons($post->link)!!}
    </div>
</div>
