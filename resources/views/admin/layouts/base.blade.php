@extends('admin.layouts.app')
@section('body-class','sidebar-mini')
@section('main')
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="{{route('home')}}" target="_blank"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('home')}}" class="nav-link" target="_blank">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <a href="{{ route('admin.logout') }}"
                       class="btn btn-default btn-flat float-right logout">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{route('home')}}" class="brand-link" target="_blank">
                <img src="{{asset('admin/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">MiMedio</span>
            </a>
            @include('admin.includes.sidebar')
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>

        @include('admin.includes.footer')
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.logout').on('click', (e) => {
                e.preventDefault();
                $('#logout-form').submit();
            });
        });
    </script>
    <script>
        (function () {
            if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                var body = document.getElementsByTagName('body')[0];
                body.className = body.className + ' sidebar-collapse';
            }
        })();
    </script>
    <script>
        // Click handler can be added latter, after jQuery is loaded...
        $('*[data-widget="pushmenu"]').click(function (event) {
            event.preventDefault();
            if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                sessionStorage.setItem('sidebar-toggle-collapsed', '');
            } else {
                sessionStorage.setItem('sidebar-toggle-collapsed', '1');
            }
        });
    </script>
@endpush
