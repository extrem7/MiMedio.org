<header class="header ">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{route('home')}}" class="logo"><img src="{{get_image('logo')}}" class="img-fluid" alt="logo-site"></a>
        <a href="" class="button btn-yellow b-lg sm-size mx-164 btn-transform d-none d-md-block">Create my own media</a>
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Search news">
            <button type="submit" class="button btn-silver-light"><i class="fas fa-search"></i></button>
            <button class="icon close-btn"><img
                    src="https://ligainform.net/wp-content/themes/ligainform.ua/assets/img/icons/close.svg" alt="">
            </button>
        </div>
        <div class="d-flex align-items-center">
            <button class="button btn-silver-light btn-mobile-search ml-25" id="search-btn"><i
                    class="fas fa-search"></i></button>
            @guest
                <nav class="menu-container">
                    <ul class="menu">
                        <li><a href="">Home</a></li>
                        <li><a href="">Users RSS Feeds</a></li>
                    </ul>
                    <a href="" class="button btn-yellow b-lg sm-size mx-164 btn-transform d-block d-md-none">Create my
                        own
                        media</a>
                    <button class="icon close-btn"><img
                            src="https://ligainform.net/wp-content/themes/ligainform.ua/assets/img/icons/close.svg"
                            alt="">
                    </button>
                </nav>
                <a href="{{route('join')}}" class="button btn-silver-light ml-25"><span class="d-block d-lg-none"><i
                            class="fas fa-sign-in-alt"></i></span><span
                        class="d-none d-lg-block">Login/Registration</span></a>
                <button class="mobile-btn ml-25" id="mobile-btn"><span></span><span></span><span></span></button>
            @endguest
            @auth
                <nav class="d-none d-lg-block">
                    <ul class="menu">
                        <li><a href="">Home</a></li>
                        <li><a href="">Following</a></li>
                    </ul>
                </nav>
                <div class="dropdown">
                    <a href="" class="profile-link ml-25 dropdown-toggle" data-toggle="dropdown">
                        <img src="{{Auth::getUser()->getAvatar('icon')}}" alt="name-person">
                        <span class="profile-name">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-account dropdown-menu-right">
                        <a href="{{route('settings')}}" class="dropdown-item">Settings</a>
                        <a href="{{route('settings.playlist')}}" class="dropdown-item">Edit playlist</a>
                        <a href="" class="dropdown-item d-block d-lg-none">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item logout">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <a href="" class="push-bell-notifications ml-25">
                    <i class="far fa-bell"></i>
                    <span class="push-badge">12</span>
                </a>
            @endauth
        </div>
    </div>
</header>
