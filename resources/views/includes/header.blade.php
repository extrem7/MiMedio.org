<header class="header ">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{route('home')}}" class="logo"><img src="{{get_image('logo')}}" class="img-fluid" alt="logo-site"></a>
        <a href="{{route(Auth::check()?'posts.create':'join')}}"
           class="button btn-yellow b-lg sm-size mx-164 btn-transform d-none d-md-block">Create my own media</a>
        @include('includes.search')
        <div class="d-flex align-items-center">
            <button class="button btn-silver-light btn-mobile-search ml-25" id="search-btn"><i
                    class="fas fa-search"></i></button>
            @guest
                <nav class="menu-container">
                    <ul class="menu">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('users.index')}}">News Channels</a></li>
                    </ul>
                    <a href="{{route('posts.create')}}"
                       class="button btn-yellow b-lg sm-size mx-164 btn-transform d-block d-md-none">
                        Create my own media</a>
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
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('users.index')}}">Channels</a></li>
                    </ul>
                </nav>
                <div class="dropdown">
                    <a href="" class="profile-link ml-25 dropdown-toggle" data-toggle="dropdown">
                        <img src="{{Auth::user()->avatar}}" alt="name-person">
                        <span class="profile-name">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-account dropdown-menu-right">
                        <a href="{{Auth::user()->link}}" class="dropdown-item">My media</a>
                        <a href="{{route('settings')}}" class="dropdown-item">Edit profile</a>
                        <a href="{{route('settings.channel')}}" class="dropdown-item">Edit channel</a>
                        <a href="{{route('profile.posts.index')}}" class="dropdown-item">My posts</a>
                        <a href="{{route('settings.playlist')}}" class="dropdown-item">My playlist</a>
                        <a href="{{route('poll')}}" class="dropdown-item">My poll</a>
                        <a href="" class="dropdown-item d-block d-lg-none">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item logout">{{ __('Logout') }}</a>
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
