@php
    /* @var \App\Models\User $user */
@endphp
<div class="chat-list-sidebar">
    @if($chats->isNotEmpty())
        <div class="box-shadow-content text-center">
            <div class="title-semi-bold blue-color">@lang('mimedio.home.chat.title')</div>
            <div class="small-size medium-bold silver-color">@lang('mimedio.home.chat.last_messages')</div>
        </div>
        <div class="box-rounded border-top-0 vertical-scroll">
            @foreach($chats as $user)
                <a href="{{route('messenger',$user->id)}}" class="chat-item">
                    <div class="avatar">
                        <img
                            src="{{$user->avatar}}"
                            alt="name-article">
                    </div>
                    <div class="chat-info">
                        <div class="name"><span class="title-nowrap">{{$user->name}} </span><span
                                class="status {{$user->is_online?'online':'offline'}}"></span></div>
                        <div class="semi-bold small-size silver-color">{{$user->last->date_diff}}</div>
                        <div class="short-text title-line-cap">{{$user->last->text}}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
    <a href="{{route('messenger')}}"
       class="box-rounded see-more {{$chats->isNotEmpty()?'border-top-0':''}} link d-block">@lang('mimedio.home.chat.link')</a>
</div>
