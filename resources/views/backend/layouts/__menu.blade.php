@if(!is_null(Auth::user()))
<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-xl">
    <div class="navbar-brand">
        <a href="{{route('admin.index')}}" class="d-inline-block">
            <img class="logo-avatar" src="{!! asset('public/img/logo_3.png') !!}" alt="logo">
        </a>
    </div>

    <div class="d-xl-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-demo3-mobile">
            <i class="icon-grid3"></i>
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-demo3-mobile">
        @if(Auth::user()->role_id == \App\User::ROLE_SUPERADMIN)
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <span>Phân quyền</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.role.index')}}" class="dropdown-item">Phân quyền</a>
                    <a href="{{route('admin.user.index')}}" class="dropdown-item">Thành viên hệ thống</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Quản lý nhân sự</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.department.index')}}" class="dropdown-item">Quản lý bộ phận</a>
                    <a href="{{route('admin.position.index')}}" class="dropdown-item">Quản lý chức vụ</a>
                    <a href="{{route('admin.staff.index')}}" class="dropdown-item">Quản lý nhân viên</a>
                    <a href="{{route('admin.vacation.index')}}" class="dropdown-item">Đề nghị xin nghỉ phép</a>
                    <a href="{{route('admin.salary.index')}}" class="dropdown-item">Quản lý bảng lương</a>
                </div>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Quản lý máy</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.machine_category.index')}}" class="dropdown-item">Danh sách loại máy</a>
                    <a href="{{route('admin.machine.index')}}" class="dropdown-item">Danh sách máy</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Quản lý kho</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.position_stock.index')}}" class="dropdown-item">{{trans('route.admin.position_stock.index')}}</a>
                    <a href="{{route('admin.import_stock.index')}}" class="dropdown-item">{{trans('route.admin.import_stock.index')}}</a>
                    {{--<a href="{{route('admin.stock_detail.index')}}" class="dropdown-item">Danh mục hàng tồn kho chi tiết</a>--}}
                    <a href="{{route('admin.export_stock.index')}}" class="dropdown-item">{{trans('route.admin.export_stock.index')}}</a>
                    <a href="{{route('admin.import_color.index')}}" class="dropdown-item">{{trans('route.admin.import_color.index')}}</a>
                    <a href="{{route('admin.export_color.index')}}" class="dropdown-item">{{trans('route.admin.export_color.index')}}</a>
                    <a href="{{route('admin.export_stock.report')}}" class="dropdown-item">{{trans('route.admin.export_stock.report')}}</a>
                    <a href="{{route('admin.export_stock.report_color')}}" class="dropdown-item">{{trans('route.admin.export_stock.report_color')}}</a>
                    <a href="{{route('admin.produced.index')}}" class="dropdown-item">{{trans('route.admin.produced.index')}}</a>
                    <a href="{{route('admin.export_semifinished.index')}}" class="dropdown-item">{{trans('route.admin.export_semifinished.index')}}</a>
                    <a href="{{route('admin.scrap.index')}}" class="dropdown-item">{{trans('route.admin.scrap.index')}}</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Khách hàng</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.customer.index')}}" class="dropdown-item">
                        Danh sách khách hàng
                    </a>
                    <a href="{{route('admin.customer_category.index')}}" class="dropdown-item">
                        Loại khách hàng
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Đơn hàng</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.order.index')}}" class="nav-link"> Đơn hàng</a>
                    <a href="{{route('admin.pattern.index')}}" class="nav-link"> Danh sách khuôn</a>
                    <a href="{{route('admin.accessory.index')}}" class="nav-link"> Danh sách linh kiện</a>
                    <a href="{{route('admin.stuff.index')}}" class="nav-link"> Danh sách chất liệu</a>
{{--                    <a href="{{route('admin.plastic.index')}}" class="nav-link"> Loại nhựa</a>--}}
                    <a href="{{route('admin.material.index')}}" class="nav-link">Loại nhựa</a>
                    <a href="{{route('admin.machine.index')}}" class="nav-link"> Danh sách máy</a>
                    <a href="{{route('admin.pattern_arrangement.index')}}" class="nav-link"> Biểu khuôn</a>
                    <a href="{{route('admin.machine_arrangement.index')}}" class="nav-link"> Biểu sắp xếp máy</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Sản phẩm</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.product.index')}}" class="nav-link">Sản phẩm</a>
                    <a href="{{route('admin.category.index')}}" class="nav-link">Danh mục sản phẩm</a>
                    <a href="{{route('admin.color.index')}}" class="nav-link">Màu sắc</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Công cụ</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.equipment.index')}}" class="nav-link">Công cụ</a>
                    <a href="{{route('admin.stock_equipment.index')}}" class="nav-link">Kho công cụ</a>
                    <a href="{{route('admin.import_equipment.index')}}" class="nav-link">Nhập công cụ</a>
                    <a href="{{route('admin.export_equipment.index')}}" class="nav-link">Xuất công cụ</a>
                    <a href="{{route('admin.repair_equipment.index')}}" class="nav-link">Sửa chữa công cụ</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Thống kê</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.machine.statistic_machine')}}" class="dropdown-item">Thống kê theo loại máy</a>
                    <a href="{{route('admin.export_stock.report')}}" class="dropdown-item">{{trans('route.admin.export_stock.report')}}</a>
                    <a href="{{route('admin.semifinished.report')}}" class="dropdown-item">{{trans('route.admin.semifinished.report')}}</a>
                    <a href="{{route('admin.export_stock.report_color')}}" class="dropdown-item">{{trans('route.admin.export_stock.report_color')}}</a>
                    <a href="{{route('admin.scrap.statistical')}}" class="dropdown-item">{{trans('route.admin.scrap.statistical')}}</a>
                    <a href="{{route('admin.customer.statistical')}}" class="dropdown-item">{{trans('route.admin.customer.statistical')}}</a>

                </div>
            </li>
        </ul>
        @else
        <ul class="navbar-nav">
            @if(in_array('admin.index', Auth::user()->role->route()))
            <li class="nav-item">
                <a href="{{route('admin.index')}}" class="navbar-nav-link">
                    <i class="icon-home4"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endif
            @if(in_array('admin.position.index', Auth::user()->role->route()) || in_array('admin.monthly_expenses.index', Auth::user()->role->route()) || in_array('admin.salary.index', Auth::user()->role->route()) || in_array('admin.work.index', Auth::user()->role->route()) || in_array('admin.staff.index', Auth::user()->role->route()) || in_array('admin.email_template.index', Auth::user()->role->route()) || in_array('admin.company.index', Auth::user()->role->route()))
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Hành chính</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if(in_array('admin.department.index', Auth::user()->role->route()))
                    <a href="{{route('admin.department.index')}}" class="dropdown-item">Quản lý bộ phận</a>
                    @endif
                    @if(in_array('admin.position.index', Auth::user()->role->route()))
                    <a href="{{route('admin.position.index')}}" class="dropdown-item">Quản lý chức vụ</a>
                    @endif
                    @if(in_array('admin.salary.index', Auth::user()->role->route()))
                    <a href="{{route('admin.salary.index')}}" class="dropdown-item">Quản lý bảng lương</a>
                    @endif
                    @if(in_array('admin.staff.index', Auth::user()->role->route()))
                    <a href="{{route('admin.staff.index')}}" class="dropdown-item">
                        Quản lý nhân viên
                    </a>
                    @endif
                    @if(in_array('admin.vacation.index', Auth::user()->role->route()))
                        <a href="{{route('admin.vacation.index')}}" class="dropdown-item">Đề nghị xin nghỉ phép</a>
                    @endif
                    @if(in_array('admin.salary.index', Auth::user()->role->route()))
                        <a href="{{route('admin.salary.index')}}" class="dropdown-item">Quản lý bảng lương</a>
                    @endif

                </div>
            </li>
            @endif
            @if(in_array('admin.export_stock.index', Auth::user()->role->route()))
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Quản lý kho</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{--<a href="{{route('admin.stock_detail.index')}}" class="dropdown-item">Danh mục hàng tồn kho chi tiết</a>--}}
                    @if(in_array('admin.position_stock.index', Auth::user()->role->route()))
                        <a href="{{route('admin.position_stock.index')}}" class="dropdown-item">{{trans('route.admin.position_stock.index')}}</a>
                    @endif
                    {{--@if(in_array('admin.stock_detail.index', Auth::user()->role->route()))
                    <a href="{{route('admin.stock_detail.index')}}" class="dropdown-item">Danh mục hàng tồn kho chi tiết</a>
                    @endif--}}
                    @if(in_array('admin.import_stock.index', Auth::user()->role->route()))
                        <a href="{{route('admin.import_stock.index')}}" class="dropdown-item">{{trans('route.admin.import_stock.index')}}</a>

                    @endif
                    @if(in_array('admin.export_stock.index', Auth::user()->role->route()))
                        <a href="{{route('admin.export_stock.index')}}" class="dropdown-item">{{trans('route.admin.export_stock.index')}}</a>
                    @endif
                    @if(in_array('admin.export_stock.report', Auth::user()->role->route()))
                        <a href="{{route('admin.export_stock.report')}}" class="dropdown-item">{{trans('route.admin.export_stock.report')}}</a>
                    @endif
                    @if(in_array('admin.semifinished.report', Auth::user()->role->route()))
                        <a href="{{route('admin.semifinished.report')}}" class="dropdown-item">{{trans('route.admin.semifinished.report')}}</a>
                    @endif
                    <a href="{{route('admin.produced.index')}}" class="dropdown-item">{{trans('route.admin.produced.index')}}</a>
                    <a href="{{route('admin.export_semifinished.index')}}" class="dropdown-item">{{trans('route.admin.export_semifinished.index')}}</a>
                </div>
            </li>
            @endif
            {{--@if(in_array('admin.order.index', Auth::user()->role->route()))
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right">

                    @if(in_array('admin.order_progress.index', Auth::user()->role->route()))
                    <a href="{{route('admin.order_progress.index')}}" class="dropdown-item">Theo dõi thực hiện đơn hàng</a>
                    @endif
                </div>
            </li>
            @endif--}}

{{--            @if(in_array('admin.supplier.index', Auth::user()->role->route()) || in_array('admin.shipping.index', Auth::user()->role->route()) || in_array('admin.oilsupplier.index', Auth::user()->role->route())|| in_array('admin.agreement.index', Auth::user()->role->route())|| in_array('admin.init.index', Auth::user()->role->route()))--}}
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Nhà cung cấp</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if(in_array('admin.supplier.index', Auth::user()->role->route()))
                    <a href="{{route('admin.supplier.index')}}" class="dropdown-item">
                        Nhà cung cấp sản phẩm
                    </a>
                    @endif
                </div>
            </li>
{{--            @endif--}}
            @if(in_array('admin.product.index', Auth::user()->role->route()) || in_array('admin.category.index', Auth::user()->role->route()))
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Quản lý sản phẩm</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if(in_array('admin.product.index', Auth::user()->role->route()))
                    <a href="{{route('admin.product.index')}}" class="nav-link">Sản phẩm</a>
                    @endif
                    @if(in_array('admin.category.index', Auth::user()->role->route()))
                    <a href="{{route('admin.category.index')}}" class="nav-link">Danh mục sản phẩm</a>
                    @endif
                    @if(in_array('admin.color.index', Auth::user()->role->route()))
                    <a href="{{route('admin.color.index')}}" class="nav-link">Màu sắc</a>
                    @endif
                </div>
            </li>
            @endif
            @if(in_array('admin.equipment.index', Auth::user()->role->route()) || in_array('admin.stock_equipment.index', Auth::user()->role->route()))
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Quản lý sản phẩm</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if(in_array('admin.equipment.index', Auth::user()->role->route()))
                    <a href="{{route('admin.equipment.index')}}" class="nav-link">Công cụ</a>
                    @endif
                    @if(in_array('admin.stock_equipment.index', Auth::user()->role->route()))
                    <a href="{{route('admin.stock_equipment.index')}}" class="nav-link">Kho công cụ</a>
                    @endif
                    @if(in_array('admin.import_equipment.index', Auth::user()->role->route()))
                    <a href="{{route('admin.import_equipment.index')}}" class="nav-link">Nhập công cụ</a>
                    @endif
                    @if(in_array('admin.export_equipment.index', Auth::user()->role->route()))
                    <a href="{{route('admin.export_equipment.index')}}" class="nav-link">Xuất công cụ</a>
                    @endif
                </div>
            </li>
            @endif
            @if(in_array('admin.machine.statistic_machine', Auth::user()->role->route()))
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <span>Thống kê</span></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{route('admin.machine.statistic_machine')}}" class="dropdown-item">Thống kê theo loại máy</a>
                        <a href="{{route('admin.export_stock.report')}}" class="dropdown-item">{{trans('route.admin.export_stock.report')}}</a>
                        <a href="{{route('admin.export_stock.report_color')}}" class="dropdown-item">{{trans('route.admin.export_stock.report_color')}}</a>
                        <a href="{{route('admin.admin.scrap.statistical')}}" class="dropdown-item">{{trans('route.admin.scrap.statistical')}}</a>
                        <a href="{{route('admin.customer.statistical')}}" class="dropdown-item">{{trans('route.admin.customer.statistical')}}</a>

                    </div>
                </li>
            @endif
        </ul>
        @endif
        <ul class="navbar-nav ml-xl-auto">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" id="seen-notification" data-toggle="dropdown">
                    <i class="icon-bell2 @if (count(Auth::user()->unreadNotifications)) bell @endif" id="ring"></i>
                    <span class="d-md-none ml-2">Thông báo</span>
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" id="count-notification">@if (count(Auth::user()->unreadNotifications)){{count(Auth::user()->unreadNotifications)}}@endif</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Thông báo</span>
                    </div>
                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list list-notification">
                            @foreach( \Auth::user()->unreadNotifications as $val)
                            <li class="media">
                                <a href="javascript:void(0)" class="seen-notification" style="width:100%" data-id="{{$val->id}}" data-link="{{$val->data['link']}}">
                                    <div class="media-body">
                                        <div class="media-title">
                                            <span class="font-weight-semibold">{{$val->data['full_name']}}</span>
                                            <span class="text-muted float-right font-size-sm">{{$val->data['time']}}</span>
                                        </div>

                                        <span class="black">{{$val->data['content']}}</span>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown-content-footer justify-content-center p-0">
                        <a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"><i class="icon-menu7 d-block top-0"></i></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle caret-0" id="seen-chat" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="d-md-none ml-2">Thông báo</span>
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" id='count-message'>@if($count_message > 0){!! $count_message !!}@endif</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-content tab-message wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Tin nhắn</span>
                        <a class="font-weight-semibold new-group" href="javacript:void(0)">Nhóm mới</a>
                    </div>
                    <div class="dropdown-content-body body-message dropdown-scrollable">
                        <ul class="media-list" id='list-message'>

                        </ul>
                    </div>
                    <div class="dropdown-content-footer justify-content-center p-0">
                        <a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"></a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <!--<img src="../../../../global_assets/images/demo/users/face11.jpg" class="rounded-circle mr-2" height="34" alt="">-->
                    <span>{!!Auth::user()->name!!}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.user.edit_profile')}}" class="dropdown-item"><i class="icon-user-plus"></i> Thông tin tài khoản</a>
                    <a href="{{route('admin.salary.view')}}" class="dropdown-item"><i class="icon-table"></i> Thông tin lương thưởng</a>
                    <a href="{{route('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Đăng xuất</a>
                </div>
            </li>
        </ul>

    </div>
</div>
<audio controls class="d-none" id="notiAudio">
    <source src="{{asset('audio/iphonenoti.mp3')}}" type="audio/ogg">
</audio>
<div id="groupchat" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo nhóm</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frmAddGroup" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    <input type="hidden" name="id" value="{!!\Auth::user()->id!!}" />
                    <input type="hidden" name="user_id[]" value="{!!\Auth::user()->id!!}"/>
                    <div class="row">
                        <div class="form-group col-md-12 row">
                            <label class="col-md-2 form-check-label text-right">Tên nhóm</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-left: 60px">
                            @foreach ($all_user as $key => $user)
                            <div class="form-check col-md-3 form-check-left row">
                                <label class="form-check-label float-left">
                                    <b>{{$user->name}}</b>
                                    <input type="checkbox" class="custom-control-input form-check-input-styled"  name="user_id[]" value="{{$user->id}}">
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-left" style="margin-top:20px">
                        <button type="submit" class="btn btn-primary legitRipple">Tạo mới</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /main navbar -->
@endif
@section('script')
@parent
<script src="https://www.gstatic.com/firebasejs/7.11.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.11.0/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.11.0/firebase-analytics.js"></script>
<script src="{!! asset('assets/global_assets/js/plugins/notifications/sweet_alert.min.js') !!}"></script>

<script>
    var firebaseConfig = {
    apiKey: "AIzaSyCc9FNLDjgwSp5nA3eA1EdChU0TtbDiky0",
    authDomain: "trangkhanh-3c0dc.firebaseapp.com",
    databaseURL: "https://trangkhanh-3c0dc.firebaseio.com",
    projectId: "trangkhanh-3c0dc",
    storageBucket: "trangkhanh-3c0dc.appspot.com",
    messagingSenderId: "240244119404",
    appId: "1:240244119404:web:b3d7c43302f4a201f20549",
    measurementId: "G-6T3787BR57"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  var database = firebase.database().ref().child('/users/');
  function writeUser(name, message, link) {
      database.push().set({
          username: name,
          message: message,
          link: link
      })
  }
  $('#bell').click(function(e){
      if (!window.Notification){
          alert('not supported');
      } else {
          Notification.requestPermission().then(function(p){
              if (p == 'denied') {
                  alert('denied');
              } else {
                  alert('allowed');
              }
          })
      }
  })
database.on('child_added', function(data){
    if (Notification.permission !== 'default') {
        var notify;
        notify = new Notification('Trang Khanh Company', {
          'title': data.val().name,
          'body': data.val().message,
          'icon': '/public/img/logo.jpg',
        });
        var link = data.val().link;
        notify.onclick = function(){
          window.open(link, '_blank');
          setCookie('user', data.ref.key,2);
        }
            //setTimeout(notify.close.bind(notify), 60000);
      } else {
          console.log('Please allow notification');
      }
})
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
    $('#seen-chat').click(function(){
        $('#count-message').html('');
    });
    $('.actve-message').click(function(){
        $('.actve-message').removeClass('actve-message');
    });
    $('body').delegate('.seen-notification', 'click', function () {
        var id = $(this).data('id');
        var link = $(this).data('link');
        $.ajax({
        url: '/api/seen-notification',
                method: 'POST',
                data:{id:id, _token : '{!! csrf_token() !!}'},
                success: function (response) {
                if (response.error == false) {
                    window.location.href = link;
                }
        }
        });
    });
    var pusher = new Pusher('caf04635050c04221170', {
        encrypted: true,
        cluster: "ap1"
    });
    var channel = pusher.subscribe('NotificationEvent');
        channel.bind('send-message', function(data) {
            console.log('outside');
            var newNotificationHtml = `
            <li class="media">
                <a href="javascript:void(0)" class="seen-notification" data-id="${data.id}" data-link="${data.link}" style="width:100%">
                <div class="media-body">
                    <div class="media-title">
                        <span class="font-weight-semibold">${data.full_name}</span>
                        <span class="text-muted float-right font-size-sm">${data.time}</span>
                    </div>
                    <span class="black">${data.content}</span>
                </div>
                </a>
            </li>
            `;
            var user_id = `${data.user_id}`;
            if (user_id == {!!\Auth::user()->id!!}){
                //console.log('inside');
                writeUser(`${data.full_name}`, `${data.content}`, `${data.link}`);
                $('.list-notification').prepend(newNotificationHtml);
                $('#ring').addClass('bell');
                $('#customer').addClass('bell');
                var x = document.getElementById("notiAudio").play();
                $('#count-notification').html(`${data.count}`);
            }
        }
    );
    $('.new-group').click(function(){
        $('#groupchat').modal('show');
    })
    $("body").delegate( "#frmAddGroup", "submit", function(e){
     e.preventDefault();
        $.ajax({
            url: '/api/add-group',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.error === false) {
                    $('#groupchat').modal('hide');
                    $('#frmAddGroup')[0].reset();
                    $('.custom-control-input').each(function () {
                        $(this).parent('span').removeClass("checked");
                        $(this).prop('checked', false);
                    });
                    swal('Thêm mới nhóm thành công');
                }else{
                    swal('Tên nhóm đã tồn tạo mời nhập tên khác');
                }
            }
        });
    })
    $(function(){
    if (getCookie('user') != '') {
        firebase.database().ref('users/' + getCookie('user')).remove();
    }
})
</script>
@stop
