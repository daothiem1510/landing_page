@extends('backend.layouts.master')
@section('content')
    <!-- Content area -->
    <div class="content">
        <!-- Table header styling -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Đơn hàng</h5>
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
            <table class="table datatable-basic">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Ngày tạo</th>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $key=>$record)
                    <tr>
                        <td>{{++$key}}</td>
                        <td class="text-left">{{date('d-m-Y',strtotime($record->created_at))}}</td>
                        <td class="text-left">{{$record->code}}</td>
                        <td class="text-left">{{$record->customer?$record->customer->name:''}}</td>
                        <td class="text-left">{{$record->total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

        $('.btn_delete').on('click', function (){
            $('#reason_id').val($(this).data('id'));
            $('#jui-dialog-overlay').dialog('open');
        });
        $('#frmReason').on('submit', function (e){
            e.preventDefault();
            $.ajax({
                url: '/api/editOrderReason',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.error == false) {
                        $('#jui-dialog-overlay').dialog('close');
                        $('#frmReason')[0].reset();
                        window.location.reload(true);
                    }
                }
            });
        });
        $('.btn_reason').on('click', function (){
            var id = $(this).data('id');
            $.ajax({
                url: '/api/getOrderReason',
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
        $('.check-material-stock').on('click',function () {
            var order_id = $(this).data('order_id');
            $.ajax({
                url:'/api/checkMaterialStock',
                method:'post',
                data:{order_id:order_id},
                success:function (response) {
                    console.log(response.keyMaterial);
                    if(response.keyMaterial.length > 0){
                        $('#list_material_result').html(response.html);
                        $('[name="material_result"]').val(response.material_result);
                        $('#order_id_in_material').val(order_id);
                        $('.title-modal-stock').html('Danh sách vật tư còn thiếu')
                    }else{
                        $('#list_material_result').html('<h5 class="text-center text-primary font-weight-bold">Kho vật tư đã sẵn sàng</h5>')
                    }

                }
            })
        })
        $('.check-color-stock').on('click',function () {
            var order_id = $(this).data('order_id');
            $.ajax({
                url:'/api/checkColorStock',
                method:'post',
                data:{order_id:order_id},
                success:function (response) {
                    if(response.color_id_result.length !== 0){
                        $('#list_color_result').html(response.html);
                        $('[name="color_result"]').val(response.color_id_result);
                        $('#order_id_in').val(order_id);
                        $('.title-modal-stock').html('Danh sách màu còn thiếu');
                    }else {
                        $('.title-modal-stock').html('Kho màu đã sãn sàng');
                        $('#list_color_result').html('');
                    }
                }
            })
        })
    </script>
@stop
