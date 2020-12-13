<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left">
                <ul>
                    @guest
                        <li><a href="{{route('home')}}">@lang('mimedio.footer.menu.home')</a></li>
                    @endguest
                    @auth
                            <li><a href="{{Auth::getUser()->link}}">@lang('mimedio.footer.menu.my_channel')</a></li>
                    @endauth
                    <li><a href="{{route('posts.index')}}">@lang('mimedio.footer.menu.all_news')</a></li>
                    <li><a href="{{route('users.index')}}">@lang('mimedio.footer.menu.all_channels')</a></li>
                    <li><a href="{{route('rss')}}">@lang('mimedio.footer.menu.rss_feeds')</a></li>
                    @guest
                        <li><a href="{{route('join')}}">@lang('mimedio.footer.menu.join')</a></li>
                    @endguest
                </ul>
                <div class="media-block mt-3">
                    <a href="{{config('mimedio.social.facebook.link')}}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{config('mimedio.social.instagram.link')}}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{config('mimedio.social.twitter.link')}}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{config('mimedio.social.youtube.link')}}" target="_blank">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="mt-3">@lang('mimedio.footer.copyright')</div>
                <div class="mt-3 d-none">@lang('mimedio.footer.dev') <a href="https://raxkor.com/" class="copyright" target="_blank">Raxkor</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0">
                    @include('includes.social')
                </div>
            </div>
        </div>
    </div>
</footer>
