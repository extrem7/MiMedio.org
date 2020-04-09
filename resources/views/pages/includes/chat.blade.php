<div class="chat-list-sidebar">
    <div class="box-shadow-content text-center">
        <div class="title-semi-bold blue-color">Chat</div>
        <div class="small-size medium-bold silver-color">Last messages</div>
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
                            class="status {{$user->isOnline()?'online':'offline'}}"></span></div>
                    <div class="semi-bold small-size silver-color">{{$user->last->date_diff}}</div>
                    <div class="short-text title-line-cap">{{$user->last->text}}</div>
                </div>
            </a>
        @endforeach
    </div>
    <a href="{{route('messenger')}}"
       class="box-rounded see-more border-top-0 link d-block">Messages</a>
</div>
