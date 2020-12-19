<aside class="main-sidebar sidebar-dark-danger elevation-1">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('backend/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MaiThai Kitchen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/img/avatar.png')}}" class="img-circle elevation-2" alt="{{ $auth['details']['full_name'] }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $auth['details']['full_name'] }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('pos.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('menu.dashboard')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route(config('app.backend_home').'.orders')}}" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>@lang('menu.orders')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route(config('app.backend_home').'.sales')}}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>@lang('menu.sales')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route(config('app.backend_home').'.customers')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>@lang('menu.customers')</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            @lang('menu.product')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.products')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.products')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            @lang('menu.categories')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.categories')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('menu.categories')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.subCategories')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('menu.sub_categories')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            @lang('menu.variants')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.variants')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('menu.variants')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.subVariant')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('menu.sub_variants')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route(config('app.backend_home').'.units')}}" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>@lang('menu.units')</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>
                            @lang('menu.offers')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.offers')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.offers')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            @lang('menu.users')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.users')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route(config('app.backend_home').'.users')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route(config('app.backend_home').'.settings')}}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>@lang('menu.settings')</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
