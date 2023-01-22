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
                <li class="nav-item menu-open">
                    <a href="{{route('AdminDashboard')}}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Basic info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ProvincesList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Provinces</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CitiesList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Cities</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('UserGroupsList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>User groups</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('UsersList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Store management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('BrandsList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CategoriesList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>
                                    Attributes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('ColorsList')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Colors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('SizesList')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sizes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('ProductsList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CouponsList')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Coupons</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('MessagesList')}}" class="nav-link">
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
