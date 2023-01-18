<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('AdminDashboard')}}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{--   admin profile     --}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" title="{{auth()->user()->FullName}}" href="">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm-left dropdown-menu-right">
                <a href="{{route('Profile')}}" class="dropdown-item">
                    <i class="fas fa-info mr-2"></i> Profile information
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('logout')}}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> logout
                </a>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{Session::get('messagesCount')}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{Session::get('messagesCount')}} Notifications</span>
                <div class="dropdown-divider"></div>
                @if(Session::get('messagesCount')!=0)
                <a href="{{route('MessagesList')}}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {{Session::get('messagesCount')}} Unread messages
{{--                    <span class="float-right text-muted text-sm">3 mins</span>--}}
                </a>
                <a href="{{route('MessagesList')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
                @endif
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">--}}
{{--                <i class="fas fa-th-large"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</nav>
<!-- /.navbar -->
