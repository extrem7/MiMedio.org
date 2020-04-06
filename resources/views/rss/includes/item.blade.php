@php
    use Carbon\Carbon;
@endphp
<div class="{{!isset($home) || (isset($home) && $loop->index==0)?'article-collapse':'channel-article-anons'}}
{{isset($home)&&$loop->index>=1?'mt-4':''}}"
     id="article-collapse-{{$item->id}}">
    <div class="box-shadow-content channel-box">
        <a href="{{$item->link}}" target="_blank" class="channel-img">
            <img src="{{$item->image}}" alt="chanel logo">
        </a>
    </div>
    @if(!isset($home) || (isset($home) && $loop->index==0))
        @foreach($item->posts as $post)
            <div class="collapse-item">
                <div class="box-shadow-content">
                    <div class="d-flex">
                        <div class="collapse-button collapsed" role="button" data-toggle="collapse"
                             data-target="#article-{{$post->id}}" aria-expanded="true"></div>
                        <div class="collapse-wrapper">
                            <a href="{{$post->link}}" target="_blank"
                               class="article-title title-line-cap">{{$post->title}}</a>
                        </div>
                        <div
                            class="title-dark extra-small-size date">{{Carbon::parse($post->date)->format('h:s')}}</div>
                    </div>
                </div>
                <div id="article-{{$post->id}}" class="collapse"
                     data-parent="#article-collapse-{{$item->id}}">
                    <div class="box-rounded border-top-0">
                        <div class="box-date mb-2">{{Carbon::parse($post->date)->format('Y.m.d')}}</div>
                        <div class="article-short-text title-line-cap">{!! $post->excerpt !!}</div>
                    </div>
                </div>
            </div>
        @endforeach
    @elseif($loop->index==1)
        <div class="box-rounded border-top-0 channel-article-anons-box inline-blocks">
            @foreach($item->posts as $post)
                <div class="article-mini-card">
                    <div class="left-column">
                        <a href="{{$post->link}}" class="article-img">
                            <img src="{{$post->image}}" alt="name-article">
                        </a>
                        <div class="divider"></div>
                    </div>
                    <div class="right-column">
                        <div class="box-date">{{Carbon::parse($post->date)->format('Y.m.d')}}</div>
                        <a href="{{$post->link}}" class="article-title title-line-cap">{{$post->title}}</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if(!isset($home))
        @auth
            @if(Auth::user()->saved_media_rss->contains($item->id))
                <form action="{{route('rss.remove',$item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="button btn-danger btn-transform b-lg w-100 semi-bold shadow-none mt-2">
                        Remove from My Media
                    </button>
                </form>
            @else
                <form action="{{route('rss.add',$item->id)}}" method="post">
                    @csrf
                    <button class="button btn-blue btn-transform b-lg w-100 semi-bold shadow-none mt-2">
                        Add to My Media
                    </button>
                </form>
            @endif
        @endauth
    @else
        <a href="{{$item->link}}" class="box-rounded see-more border-top-0 link d-block" target="_blank">See all
            news</a>
    @endif
</div>
