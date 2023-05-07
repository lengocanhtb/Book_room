<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="mx-3 brand-text font-weight-light">{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('admin.dashboard')}}" @if (strstr( $_SERVER['REQUEST_URI'], '/admin/dashboard' ) == true)  class="nav-link active" @else class = "nav-link" @endif>--}}
{{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                        <p>--}}
{{--                            Trang chủ--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}" @if (strstr( $_SERVER['REQUEST_URI'], '/admin/user' ) == true)  class="nav-link active" @else class = "nav-link" @endif>
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Người dùng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.rooms.index')}}" @if (strstr( $_SERVER['REQUEST_URI'], '/admin/room' ) == true)  class="nav-link active" @else class = "nav-link" @endif>
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Nhà trọ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.listReport')}}" @if (strstr( $_SERVER['REQUEST_URI'], '/admin/list-report' ) == true)  class="nav-link active" @else class = "nav-link" @endif>
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            Report
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('auth.logout')}}" @if (strstr( $_SERVER['REQUEST_URI'], 'logout' ) == true)  class="nav-link active" @else class = "nav-link" @endif>
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>
                            Đăng xuất
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
