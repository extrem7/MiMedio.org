@php
    /* @var $user App\Models\User
    * @var $users \Illuminate\Support\Collection
    */
@endphp

@if($followings)
    <div class="mob-accordion following-box vertical-scroll mb-3">
        <button class="button btn-silver-light mob-accordion-btn mx-164"><i
                class="fas fa-user mr-2"></i>@lang('mimedio.home.followings')
        </button>
        <div class="mob-wrapper">
            <div class="following-mobile-box">
                @foreach($followings as $user)
                    <div class="box-shadow-content channel-info-box">
                        <div class="item">
                            <a href="{{$user->link}}" class="profile-box">
                                <img src="{{$user->avatar}}" alt="name-article">
                                <div class="name title-nowrap">{{$user->name}}</div>
                            </a>
                        </div>
                        <follow-button :user_id="{{$user->id}}"
                                       :initial_following="{{is_following($user)?'true':'false'}}">
                        </follow-button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
