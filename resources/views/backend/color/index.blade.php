@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Danh sách màu</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.color.index')}}" method="GET" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tên khách hàng</label>
                        <select class="select-search form-control" name="color_id" data-placeholder="Chọn tên khách hàng">
                            {!! $color_html !!}
                        </select>
                    </div>
                    <div class="col-md-2 text-left">
                        <button type="submit" style="margin-top:27px;" class="btn btn-primary btnSearch">Tìm kiếm <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </form><br>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert bg-success alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
            @endif
        </div>

        <table class="table table-active table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên màu</th>
                    <th class="text-center">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$record->name}}</td>
                    <td class="text-center">
                            <a href="{{route('admin.color.edit', $record->id)}}" title="Chỉnh sửa"><i class="icon-pencil"></i></a>
                        <form action="{!! route('admin.color.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <a title="Xóa" class="delete text-danger" data-action="delete">
                                <i class="icon-trash"></i>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /content area -->
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/effects.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/jqueryui_components.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
<script>
$('.edit-info').on('click', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/api/getCustomer ',
                method: 'POST',
                data: {id:id},
                success: function (response) {
                    if (response.error == false) {
                       $('#name').html(response.data.name);
                       $('#account_number').html(response.data.account_number);
                       $('#address').html(response.data.address);
                       $('#fax').html(response.data.fax);
                       $('#representer').html(response.data.representer);
                       $('#contact_name').html(response.data.contact_name);
                       $('#assets').html(response.data.assets);
                       $('#company_name').html(response.data.company_name);
                       $('#checkout_time').html(response.data.checkout_time);
                       $('#tax_code').html(response.data.tax_code);
                       $('#bank').html(response.data.bank);
                       $('#phone').html(response.data.phone);
                       $('#email').html(response.data.email);
                       $('#position').html(response.data.position);
                       $('#charter_capital').html(response.data.charter_capital_format);
                       $('#category').html(response.data.category);
                       $('#limit_money').html(response.data.limit_money_format);
                       $('#jui-dialog-basic').dialog('open');
                    }
                }
    });
});
 $('.btn_delete').on('click', function (){
        $('#customer_id').val($(this).data('id'));
        $('#jui-dialog-overlay').dialog('open');
    });
$('#frmCustomer').on('submit', function (e){
    e.preventDefault();
    $.ajax({
        url: '/api/editCustomer ',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            if (response.error == false) {
                $('#jui-dialog-overlay').dialog('close');
                $('#frmCustomer')[0].reset();
                window.location.reload(true);
            }
        }
    });
});
$('.btn_reason').on('click', function (){
    var id = $(this).data('id');
    $.ajax({
        url: '/api/getNote',
                method: 'POST',
                data: {id:id},
                success: function (response) {
                    if (response.error == false) {
                       $('#note').html(response.note);
                       $('#jui-dialog-resize').dialog('open');
                    }
                }
    });
});
</script>
@stop
