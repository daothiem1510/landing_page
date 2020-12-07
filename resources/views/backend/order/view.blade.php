@extends('backend.layouts.master')
@section('content')
    <div class="content page-order">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Xem chi tiết</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <input type="hidden" name="created_by" value="{!! \Auth::user()->id !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-left">Mã đơn gia công</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="code" value="{!!$record->code!!}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-left">Đơn vị sản xuất<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="unit" value="{!! $record->unit !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-left">Khách hàng <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="unit" value="{!! $record->customer->name !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-left">Người liên hệ<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="contact" value="{!! $record->contact !!}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-check-label col-md-3 text-left">Ngày  <span class="text-danger">*</span></label>
                                <div class="input-group col-md-9">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickadate" placeholder="Ngày bắt đầu" name="date" required value="{{ date('d/m/Y', strtotime($record->date)) }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Danh sách sản phẩm</h4>
                                </div>
                            </div>
                            <div class="product">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-left">Mã khuôn</th>
                                            <th class="text-center">Mã linh kiện</th>
                                            <th class="text-center">Tên linh kiện</th>
                                            <th class="text-center">C.liệu/Màu</th>
                                            <th class="text-center">Trọng lượng (mỗi bia)</th>
                                            <th class="text-center">Trọng lượng (mỗi cái)</th>
                                            <th class="text-center">Lỗ.k</th>
                                            <th class="text-center">Chu kỳ</th>
                                            <th class="text-center">SLYC</th>
                                            <th class="text-center">Đơn giá</th>
                                            <th class="text-center">Thành tiền</th>
                                            <th class="text-center">Loại máy</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($record->orderDetail as $item)
                                        <tr>
                                            <td class="text-left">{{ $item->patternRelation->code }}</td>
                                            <td class="text-left">{{ $item->accessory->code }}</td>
                                            <td class="text-left">{{ $item->accessory->name }}</td>
                                            <td class="text-left">{{$item->material_id > 0?$item->material->name:''}}/{{ $item->color_id > 0?$item->color->code:'' }}</td>
                                            <td class="text-right">{{ $item->weight_b }}</td>
                                            <td class="text-right">{{ $item->weight_c }}</td>
                                            <td class="text-center">{{ $item->pattern }}</td>
                                            <td class="text-center">{{ $item->period }}</td>
                                            <td class="text-right">{{ number_format($item->quantity) }}</td>
                                            <td class="text-right">{{ number_format($item->price) }}</td>
                                            <td class="text-right">{{ number_format($item->into_money) }}</td>
                                            <td class="text-left">{{ $item->machine->name }} - {{ $item->machine->category }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" colspan="10">TOTAL</td>
                                            <td class="text-right">{{ number_format($record->total_order) }}</td>
                                            <td class="text-center" colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </fieldset>
                        <div class="text-right mt-4 ">
                            @if($record->status <= \App\Order::STATUS_ACTIVE)
                                @if ((in_array('admin.order.toggle_1', \Auth::user()->role->route()) && $record->status==\App\Order::STATUS_WAIT ) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                                    <a href="{{route('admin.order.toggle_1', [$record->id, $record->status])}}" title="Duyệt" class="text-success"><i class="icon-checkmark"></i></a>
                                    <a href="javascript:void(0)" data-id='{{$record->id}}' class="success btn btn-danger btn_delete">Hủy</a>
                                @elseif ((in_array('admin.order.toggle_2', \Auth::user()->role->route()) && $record->status==\App\Order::STATUS_LEVEL_1) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                                    <a href="{{route('admin.order.toggle_2', [$record->id, $record->status])}}" title="Duyệt" class="text-success"><i class="icon-checkmark"></i></a>
                                    <a href="javascript:void(0)" data-id='{{$record->id}}' class="success btn btn-danger btn_delete">Hủy</a>
                                @elseif  ((in_array('admin.order.toggle_3', \Auth::user()->role->route()) && $record->status==\App\Order::STATUS_LEVEL_2) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                                    <a href="{{route('admin.order.toggle_3', [$record->id, $record->status])}}" title="Duyệt" class="text-success"><i class="icon-checkmark"></i></a>
                                    <a href="javascript:void(0)" data-id='{{$record->id}}' class="success btn btn-danger btn_delete">Hủy</a>
                                @elseif ((in_array('admin.order.toggle_4', \Auth::user()->role->route()) && $record->status==\App\Order::STATUS_LEVEL_3) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                                    <a href="{{route('admin.order.toggle_4', [$record->id, $record->status])}}" title="Duyệt" class="text-success"><i class="icon-checkmark"></i></a>
                                    <a href="javascript:void(0)" data-id='{{$record->id}}' class="success btn btn-danger btn_delete">Hủy</a>
                                @endif
                            @elseif($record->status == \App\Order::STATUS_CANCEL)
                                <a type="button" href="javascript:void(0)" class="btn btn-danger legitRipple" >Đã hủy</a>
                            @endif
                            <a type="button" href="{{route('admin.order.index')}}" class="btn btn-secondary legitRipple" >Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="jui-dialog-overlay" title="Lí do hủy">
        <form id="frmReason" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <input type="hidden" id="reason_id" name="id" />
            <input type="hidden" value="{!!\Auth::user()->id!!}" name="user_id" />
            <div class="panel panel-body results">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <textarea name='note' class='form-control' cols="10" rows="10" required>{!!old('note')!!}</textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="text-left" style="margin-top:20px">
                    <button type="submit" class="btn btn-primary legitRipple">Lưu</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section('script')
    @parent
    <script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/ui/moment/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/pickers/anytime.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.date.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.time.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/legacy.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/core.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/effects.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/jqueryui_components.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/notifications/sweet_alert.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/form_select2.js') !!}"></script>
    <script src="{!! asset('assets/backend/js/order.js') !!}"></script>
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
    </script>
@stop
