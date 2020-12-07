<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{!! asset('') !!}" width="38" height="38"
                                         class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{!!Auth::user()->name!!}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> Buffalo Store
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                    <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link active">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.user.index')}}" class="nav-link">
                        <i class="icon-user-tie"></i>
                        <span>Thành viên hệ thống</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Đơn hàng</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item">
                            <a href="{{route('admin.order.index')}}" class="nav-link"><i class="icon-copy"></i>
                                <span>Quản lý đơn hàng</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.customer.index')}}" class="nav-link">
                        <i class="icon-list-unordered"></i>
                        <span>Quản lý khách hàng</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Quản lý sản phẩm</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.product.index')}}" class="nav-link">Sản phẩm</a>
                        </li>
                        <li class="nav-item"><a href="{{route('admin.category.index')}}" class="nav-link">Danh mục sản
                                phẩm</a></li>
                        <li class="nav-item"><a href="{{route('admin.size.index')}}" class="nav-link">Thêm mới size</a></li>
                        <li class="nav-item"><a href="{{route('admin.color.index')}}" class="nav-link">Danh mục màu</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Quản lý người dùng</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.user.index')}}" class="nav-link">Sản phẩm</a>
                        </li>
                        <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">Đăng xuất</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Quản lý nhân viên</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.staff.index')}}" class="nav-link">Nhân viên</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Page</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('admin.page.index')}}" class="nav-link">{{trans('route.admin.page.index')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.menu.index')}}" class="nav-link">{{trans('route.admin.menu.index')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.head.index')}}" class="nav-link">{{trans('route.admin.head.index')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.body.index')}}" class="nav-link">{{trans('route.admin.body.index')}}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
