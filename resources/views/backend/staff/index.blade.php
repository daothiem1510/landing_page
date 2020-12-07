@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Nhân viên</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert bg-success alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
            @endif
        </div>
        <table class="table  datatable-basic table-staff" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Số thẻ</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Chức vụ</th>
                    <th>Bằng cấp</th>
                    <th>Giấy khám sức khỏe</th>
                    <th>Trạng thái</th>
                    <th>Hiện tại</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$record->code}}</td>
                    <td>{{$record->full_name}}</td>
                    <td>{{date('d/m/Y', strtotime($record->dob))}}</td>
                    <td class="text-center">@if($record->gender == 1) Nam @else Nữ @endif</td>
                    <td>@if($record->position){{$record->position->name}}@endif</td>
                    <td ><a href="#" data-id ="{{$record->id}}" class="degrees-view">Xem chi tiết</a></td>
                    <td ><a href="#" data-id ="{{$record->id}}" class="file-view">Xem chi tiết</a></td>
                    <td>
                        @if($record->status == 1)
                        <span class="badge bg-success-400">Kích hoạt</span>
                        @else
                        <span class="badge bg-grey-400">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        @if($record->is_deleted == 0)
                        <span class="badge bg-success-400">Đang làm</span>
                        @else
                        <span class="badge bg-grey-400">Đã nghỉ</span>
                        @endif
                    </td>
                    <td class="text-center">
{{--                        @if((in_array('admin.staff.edit', \Auth::user()->role->route()) || \Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR))--}}
                        <a href="{{route('admin.staff.edit', $record->id)}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
{{--                        @endif--}}
{{--                        @if((in_array('admin.staff.destroy', \Auth::user()->role->route()) || \Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR))--}}
                            <form action="{!! route('admin.staff.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <a title="{!! trans('base.delete') !!}" class="delete text-danger" data-action="delete">
                                <i class="icon-trash"></i>
                            </a>
                        </form>
{{--                        @endif--}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /table header styling -->

</div>
<div id="degrees-view" class="modal fade" tabindex="-1" style="z-index:1600">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bằng cấp</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="degrees row"></div>
            </div>

        </div>
    </div>
</div>
<div id="file-view" class="modal fade" tabindex="-1" style="z-index:1600">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Giấy khám sức khỏe</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="files row"></div>
            </div>

        </div>
    </div>
</div>

<!-- /content area -->
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_extension_buttons_init.js') !!}"></script>

<script src="{!! asset('assets/backend/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/dataTables.buttons.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/buttons.flash.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/jszip.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/pdfmake.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/vfs_fonts.js') !!}"></script>
<script src="{!! asset('assets/backend/js/buttons.html5.min.js') !!}"></script>
<script src="{!! asset('assets/backend/js/buttons.print.min.js') !!}"></script>
<script>
    $('body').delegate('.degrees-view', 'click', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/degreesView',
            method: 'POST',
            data: {id: id},
            success: function (response) {
                if (response.error == false) {
                    $('.degrees').html(response.html);
                    $('#degrees-view').modal('show')
                }
            }
        });
    });
    $('body').delegate('.file-view', 'click', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/filesView',
            method: 'POST',
            data: {id: id},
            success: function (response) {
                if (response.error == false) {
                    $('.files').html(response.html);
                    $('#file-view').modal('show')
                }
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        var table = $('.table-staff').DataTable({
            "paging":true,
            "pageLength": 25,
            "language": {
                search: '<span>Lọc:</span> _INPUT_',
                searchPlaceholder: 'Nhập từ khóa tìm kiếm',
                lengthMenu: '<span>Hiển thị:</span> _MENU_',
                paginate: {
                    'numbers': 100,
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                },
                info: "Hiển thị từ _START_ đến _END_ trên _TOTAL_ kết quả "

            },
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    });
</script>
@stop
