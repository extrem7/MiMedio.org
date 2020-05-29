<header class="header ">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{route('home')}}" class="logo"><img src="{{get_image('logo')}}" class="img-fluid" alt="logo-site"></a>
        <a href="{{route(Auth::check()?'settings.channel':'join')}}"
           class="button btn-yellow b-lg sm-size mx-164 btn-transform d-none d-md-block">@lang('mimedio.header.create_post')</a>
        @include('includes.search')
        <div class="d-flex align-items-center">
            <button class="button btn-silver-light btn-mobile-search ml-25" id="search-btn"><i
                    class="fas fa-search"></i></button>
            @guest
                <nav class="menu-container">
                    <ul class="menu">
                        <li><a href="{{route('home')}}">@lang('mimedio.header.menu.home')</a></li>
                        <li><a href="{{route('users.index')}}">@lang('mimedio.header.menu.all_channels')</a></li>
                    </ul>
                    <a href="{{route('posts.create')}}"
                       class="button btn-yellow b-lg sm-size mx-164 btn-transform d-block d-md-none">
                        @lang('mimedio.header.create_post')</a>
                    <button class="icon close-btn">
                        <img src="https://ligainform.net/wp-content/themes/ligainform.ua/assets/img/icons/close.svg"
                             alt="">
                    </button>
                </nav>
                <a href="{{route('join')}}" class="button btn-silver-light ml-25"><span class="d-block d-lg-none"><i
                            class="fas fa-sign-in-alt"></i></span><span
                        class="d-none d-lg-block">@lang('mimedio.header.login/register')</span></a>
                <button class="mobile-btn ml-25" id="mobile-btn"><span></span><span></span><span></span></button>
            @endguest
            @auth
                <nav class="d-none d-lg-block">
                    <ul class="menu">
                        <li><a href="{{Auth::getUser()->link}}">@lang('mimedio.header.menu.my_channel')</a></li>
                        <li><a href="{{route('users.index')}}">@lang('mimedio.header.menu.all_channels')</a></li>
                    </ul>
                </nav>
                <div class="dropdown">
                    <a href="#" class="profile-link ml-25 dropdown-toggle" data-toggle="dropdown">
                        <img src="{{Auth::getUser()->avatar}}" alt="name-person">
                        <span class="profile-name">{{Auth::getUser()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-account dropdown-menu-right">
                        <a href="{{route('settings.channel')}}" class="dropdown-item">@lang('mimedio.header.dropdown.edit_channel')</a>
                        <a href="{{route('users.index')}}" class="dropdown-item d-block d-lg-none">@lang('mimedio.header.dropdown.all_channels')</a>
                        <a href="{{route('settings.page')}}" class="dropdown-item">@lang('mimedio.header.dropdown.edit_profile')</a>
                        <a href="{{route('profile.posts.index')}}" class="dropdown-item">@lang('mimedio.header.dropdown.posts')</a>
                        <a href="{{route('settings.playlist')}}" class="dropdown-item">@lang('mimedio.header.dropdown.playlist')</a>
                        <a href="{{route('poll.page')}}" class="dropdown-item">@lang('mimedio.header.dropdown.poll')</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item logout">@lang('mimedio.header.dropdown.logout')</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                @include('includes.notifications-bell')
            @endauth
        </div>
    </div>
</header>
