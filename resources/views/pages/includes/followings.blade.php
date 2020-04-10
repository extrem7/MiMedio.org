@php
    /* @var $user App\Models\User
    * @var $users \Illuminate\Support\Collection
    */
@endphp

@if($followings)
    <div class="mob-accordion following-box mb-3">
        <button class="button btn-silver-light mob-accordion-btn mx-164"><i
                class="fas fa-user mr-2"></i>Following
        </button>
        <div class="mob-wrapper">
            @foreach($followings as $user)
                <div class="box-shadow-content channel-info-box">
                    <div class="item">
                        <a href="{{$user->link}}" class="profile-box">
                            <img src="{{$user->avatar}}" alt="name-article">
                            <div class="name title-nowrap">{{$user->name}}</div>
                        </a>
                    </div>
                    @if($user->new_posts)
                        <div class="item">
                            <a href="{{$user->link}}"><span class="blue-color">{{$user->new_posts}}</span> new posts
                                today</a>
                        </div>
                    @endif
                    <div class="item">
                        <follow-button :user_id="{{$user->id}}"
                                       :initial_following="{{is_following($user)}}">
                        </follow-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
