@php
    /* @var $playlist Playlist
    */use App\Models\Playlist;

    $firstVideo = $playlist->videos[0]
@endphp
<div class="video-channel mb-4 {{$class??''}}">
    <div class="channel-name title-nowrap">{{$playlist->title}}</div>
    <div class="channel-main-video">
        <div id="player" class="youtube-player" data-main="{{$firstVideo['id']}}"
             data-item="{{$firstVideo['id']}}"></div>
    </div>
    <div class="channel-play-box">
        <div class="play-btn"><i class="fas fa-play"></i></div>
        <div class="video-name">{{$firstVideo['title']}}</div>
        <div class="time">{{$firstVideo['duration']}}</div>
    </div>
    <div class="channel-video-list">
        @foreach($playlist->videos as $video)
            <div class="video-item" data-id="{{$video['id']}}">
                <img src="https://img.youtube.com/vi/{{$video['id']}}/default.jpg" alt="{{$video['title']}}">
                <div>
                    <div class="video-name title-line-cap">{{$video['title']}}</div>
                    <div class="time">{{$video['duration']}}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@push('scripts')
    <script>
        var tag = document.createElement('script')

        tag.src = "https://www.youtube.com/iframe_api"
        var firstScriptTag = document.getElementsByTagName('script')[0]
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag)
    </script>
@endpush
