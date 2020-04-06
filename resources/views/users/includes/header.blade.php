@php
    /* @var $user App\Models\User
    * @var $categories App\Models\Category[]
    */
@endphp
<div class="row channel-others-users">
    <div class="col-12 col-lg-8">
        <div class="d-flex align-items-center flex-column flex-lg-row">
            <a href="{{$user->link}}"><img src="{{$user->logo}}" alt="{{$user->name}}" class="mr-4 logo-channel"></a>
            <ul class="category-tab-list horizontal-overflow br-0 mt-4 mt-lg-0">
                @foreach($categoriesWithPosts as $id=>$item)
                    <li>
                        <a class="{{isset($category)&&$category->id==$id?'active':''}}"
                           href="{{route('users.show.category',[
                           'user'=>$user->id,
                           'category'=>$item->slug
                           ])}}">{{$item->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="box-shadow-content channel-info-box mt-4 mt-lg-0">
            <div class="item">
                <a href="{{$user->link}}" class="profile-box">
                    <img src="{{$user->avatar}}" alt="{{$user->name}}">
                    <div class="name title-nowrap">{{$user->name}}</div>
                </a>
            </div>
            <followers :user_id="{{$user->id}}"
                       :initial_followers="{{$user->followers_count}}"></followers>
            @if(!is_current_user($user))
                <follow-button :user_id="{{$user->id}}" :initial_following="{{is_following($user)}}">
                </follow-button>
            @endif
        </div>
    </div>
</div>
