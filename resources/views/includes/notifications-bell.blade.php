<a href="{{route('messenger')}}" class="push-bell-notifications ml-25">
    <i class="far fa-bell"></i>
    @if($unread)
        <span class="push-badge">{{$unread>99?'∞':$unread}}</span>
    @endif
</a>
