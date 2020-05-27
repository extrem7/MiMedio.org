@if(isset($categories))
    <div class="d-flex justify-content-center mb-5">
        <ul class="category-tab-list horizontal-scroll horizontal-overflow">
            <li><a href="{{route('posts.index')}}" class="{{Nav::isRoute('posts.index')}}">@lang('mimedio.posts.all_news')</a></li>
            @foreach($categories as $slug=>$name)
                <li><a @if(isset($category))class="{{$category->slug==$slug?'active':''}}" @endif
                    href="{{route('categories.show',$slug)}}">{{$name}}</a></li>
            @endforeach
        </ul>
    </div>
@endif
