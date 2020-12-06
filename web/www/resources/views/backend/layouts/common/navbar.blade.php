<nav class="main-header navbar navbar-expand navbar-dark text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(config('app.backend_home').'.dashboard')}}" class="nav-link">{{ __('menu.dashboard')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(config('app.backend_home'))}}" class="nav-link">@lang('menu.pos')</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(config('app.backend_home').'.orders')}}" class="nav-link">@lang('menu.orders')</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(config('app.backend_home').'.sales')}}" class="nav-link">@lang('menu.sales')</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(config('app.backend_home').'.settings')}}" class="nav-link">@lang('menu.settings')</a>
        </li>
    </ul>

{{--    <!-- SEARCH FORM -->--}}
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(config('app.backend_home').'.logout')}}" class="nav-link">@lang('menu.logout')</a>
        </li>
    </ul>
</nav>
