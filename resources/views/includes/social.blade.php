<div class="subscribe-block">
    <a href="{{$social['facebook']['link']}}" class="subscribe-item facebook" target="_blank">
        <div class="subscribe-info"><i class="fab fa-facebook-f"></i> <span>{{$social['facebook']['count']}}</span>
            <span>@lang('mimedio.footer.social.facebook.count')</span></div>
        <div class="text-uppercase subscribe-action">@lang('mimedio.footer.social.facebook.action')</div>
    </a>
    <a href="{{$social['instagram']['link']}}" class="subscribe-item instagram" target="_blank">
        <div class="subscribe-info"><i class="fab fa-instagram"></i> <span
                id="instagram-counter">{{$social['instagram']['count']}}</span>
            <span>@lang('mimedio.footer.social.instagram.count')</span>
        </div>
        <div class="text-uppercase subscribe-action">@lang('mimedio.footer.social.instagram.action')</div>
    </a>
    <a href="{{$social['twitter']['link']}}" class="subscribe-item twitter" target="_blank">
        <div class="subscribe-info"><i class="fab fa-twitter"></i> <span
                id="twitter-counter">{{$social['twitter']['count']}}</span>
            <span>@lang('mimedio.footer.social.twitter.count')</span>
        </div>
        <div class="text-uppercase subscribe-action">@lang('mimedio.footer.social.twitter.action')</div>
    </a>
    <a href="{{$social['youtube']['link']}}" class="subscribe-item youtube" target="_blank">
        <div class="subscribe-info"><i class="fas fa-play"></i> <span
                id="youtube-counter">{{$social['youtube']['count']}}</span>
            <span>@lang('mimedio.footer.social.youtube.count')</span>
        </div>
        <div class="text-uppercase subscribe-action">@lang('mimedio.footer.social.youtube.action')</div>
    </a>
</div>
