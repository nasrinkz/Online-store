<!-- IMain Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3" style="text-align: center!important;">
            <div class="info" style="text-align: center!important;">
                <a href="{{route('Profile')}}" class="d-block">{{auth()->user()->FullName}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item {{ Request::segment(2)  == '' ? 'menu-open' : '' }}">
                    <a href="{{route('AdminDashboard')}}" class="nav-link {{Request::segment(2)  == '' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item @if(request()->is('*/Provinces') or request()->is('*/EditProvince/*') or request()->is('*/Cities') or request()->is('*/EditCity/*')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Basic info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ProvincesList')}}" class="nav-link @if(request()->is('*/Provinces') or request()->is('*/EditProvince/*')) active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Provinces</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CitiesList')}}" class="nav-link @if(request()->is('*/Cities') or request()->is('*/EditCity/*')) active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Cities</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('*/Users') or request()->is('*/EditUser/*') or request()->is('*/UserGroups')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('UserGroupsList')}}" class="nav-link {{ request()->is('*/UserGroups') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>User groups</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('UsersList')}}" class="nav-link {{ request()->is('*/Users') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if(request()->is('*/Brands') or request()->is('*/EditBrand/*') or request()->is('*/Categories') or request()->is('*/EditCategory/*') or request()->is('*/Colors') or request()->is('*/EditColor/*') or request()->is('*/Sizes') or request()->is('*/EditSize/*') or request()->is('*/Products') or request()->is('*/EditProduct/*') or request()->is('*/Coupons') or request()->is('*/EditCoupon/*')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Store management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('BrandsList')}}" class="nav-link @if(request()->is('*/Brands') or request()->is('*/EditBrand/*')) active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CategoriesList')}}" class="nav-link @if(request()->is('*/Categories') or request()->is('*/EditCategory/*')) active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item @if(request()->is('*/Colors') or request()->is('*/EditColor/*') or request()->is('*/Sizes') or request()->is('*/EditSize/*')) menu-open @endif">
                            <a href="#" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>
                                    Attributes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('ColorsList')}}" class="nav-link @if(request()->is('*/Colors') or request()->is('*/EditColor/*')) active @endif ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Colors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('SizesList')}}" class="nav-link @if(request()->is('*/Sizes') or request()->is('*/EditSize/*')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sizes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('ProductsList')}}" class="nav-link @if(request()->is('*/Products') or request()->is('*/EditProduct/*')) active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CouponsList')}}" class="nav-link @if(request()->is('*/Coupons') or request()->is('*/EditCoupon/*')) active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Coupons</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('MessagesList')}}" class="nav-link @if(request()->is('*/Messages') or request()->is('*/ShowDetails/*')) active @endif">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Messages
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
