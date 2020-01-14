<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image d-flex align-items-center">
            <img src="{{Auth::getUser()->getAvatar('icon')}}" class="avatar img-circle elevation-2"
                 alt="User Image">
        </div>
        <div class="info d-flex align-items-center">
            <p class="d-block text-white m-0">{{$name}}</p>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link {{ Nav::isRoute('admin.dashboard') }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ config('app_settings.url') }}" class="nav-link {{ Nav::urlDoesContain('settings') }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Settings</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.categories.index')}}" class="nav-link {{ Nav::isResource('categories') }}">
                    <i class="nav-icon fas fa-bookmark"></i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.posts.index')}}" class="nav-link {{ Nav::isResource('posts') }}">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>Posts</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.users.index')}}" class="nav-link {{ Nav::isRoute('admin.users.index') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
