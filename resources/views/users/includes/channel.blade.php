@php
    /* @var $user App\Models\User
    * @var $channel App\Models\User
    */
@endphp
<div class="col-md-6 col-xl-4 mb-3 channels-category">
    <div class="box-shadow-content channel-info-box">
        <div class="item justify-content-between category-name">
            <a href="{{$channel->link}}" class="title-dark title-nowrap">{{$channel->name}}</a>
            @auth
                @if($user->id ===$channel->id)
                    <a href="{{route('settings.channel')}}" class="icon blue-color edit-post-btn">
                        <i class="fas fa-edit"></i>
                    </a>
                @endif
            @endauth
        </div>
        <div class="item">
            <user-follow-button :user_id="{{$channel->id}}"
                                :initial_following="{{is_following($channel)}}"
                                :initial_followers="{{$channel->followers_count}}"
                {{is_current_user($channel)?'disabled':''}}></user-follow-button>
        </div>
    </div>
    <div class="box-rounded up-to-top border-top-0">
        <img src="{{$channel->getLogo()}}" alt="">
        <div class="category-info d-flex align-items-center justify-content-between mt-3">
            <div class="d-flex flex-wrap mr-3">
                <a href="" class="inherit-color medium-bold"><span
                        class="blue-color semi-bold">{{$channel->posts_count}}</span>
                    posts</a>
                <a href="" class="inherit-color medium-bold"><span
                        class="blue-color semi-bold">{{$channel->likes_count}}</span>
                    likes</a>
                <a href="" class="inherit-color medium-bold"><span
                        class="blue-color semi-bold">{{$channel->dislikes_count}}</span>
                    dislikes</a>
                <a href="" class="inherit-color medium-bold"><span class="blue-color semi-bold">35</span>
                    shares</a><!--todo-->
            </div>
            <copy-button link="{{$channel->link}}"></copy-button>
        </div>
    </div>
</div>
