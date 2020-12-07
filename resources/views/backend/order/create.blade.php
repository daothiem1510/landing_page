@extends('backend.layouts.master')
@section('content')
    <div class="content page-order">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Tạo mới</h5>
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
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">{!! Session::get('error') !!} </span>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{!!route('admin.order.store')!!}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <input type="hidden" name="created_by" value="{!! \Auth::user()->id !!}" />
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-left">Mã đơn gia công</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="code" value="{!!old('code')!!}" >
                                        {!! $errors->first('code', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-left">Đơn vị sản xuất<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="unit" value="{!!old('unit')!!}" >
                                        {!! $errors->first('unit', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-left">Khách hàng <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="select-search form-control validate" id="customer" name="customer_id" data-placeholder="Chọn khách hàng" required>
                                            {!!$customer_html!!}
                                        </select>
                                        {!! $errors->first('customer_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-left">Người liên hệ<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="contact" value="{!!old('contact')!!}" >
                                        {!! $errors->first('contact', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="form-check-label col-md-3 text-left">Ngày giao <span class="text-danger">*</span></label>
                                    <div class="input-group col-md-9">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                        </span>
                                        <input type="text" class="form-control pickadate" placeholder="Ngày bắt đầu" name="date" required value="{{date('d/m/Y')}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Danh sách sản phẩm</h4>
                                    </div>
                                </div>
                                <div class="product">
                                    <div class="row border-top-1 mb-1 pt-3 item" >
                                        <div class="form-group col-md-2 d-none">
                                            <label class="required">SKU</label>
                                            <input name="sku[]" value="{{old('sku')}}" type="text" class="form-control validate">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required">Mã khuôn</label>
                                            <select name="pattern_id[]" data-placeholder="Chọn mã khuôn" class="pattern_id select-search form-control select validate" data-fouc>
                                                {!! $pattern_html !!}
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required">Mã linh kiện</label>
                                            <select name="accessory_id[]" data-placeholder="Chọn linh kiện" class="accessory_id select-search form-control select validate" data-fouc>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required">Tên linh kiện</label>
                                            <input name="" value="" type="text" class="accessory_name form-control validate" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required">Chất liệu</label>
                                            <select name="material_id[]" data-placeholder="Chọn chất liệu" class="material_id select-search form-control select validate" data-fouc>
                                                {!! $material_html !!}
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required">Màu</label>
                                            <select name="color_id[]" data-placeholder="Chọn màu" class="material_color select-search form-control select validate" data-fouc>
                                                {!! $color_html !!}
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="required">TL (mỗi bìa)</label>
                                            <input name="weight_b[]" readonly type="text" class="weight_b form-control validate">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="required">TL (mỗi cái)</label>
                                            <input name="weight_c[]" readonly type="text" class="weight_c form-control validate">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="required">Lỗ khuôn</label>
                                            <input name="pattern[]" type="number" min="0" class="form-control pattern" readonly>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="required">Chu kì</label>
                                            <input name="period[]" type="text" class="form-control period validate" >
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="required">SLYC</label>
                                            <input id="quantity[]" autocomplete="off" onkeyup="formatValue(this)" type="text" class="form-control quantity_format validate" value="">
                                            <input type="hidden" name="quantity[]" value="" class="form-control quantity">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="required">Đơn giá</label>
                                            <input id="price[]" autocomplete="off" onkeyup="formatValue(this)" type="text" class="form-control price_format validate" value="">
                                            <input type="hidden" name="price[]" value="" class="form-control price ">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="required">Thành tiền</label>
                                            <input id="into_money[]" autocomplete="off" onkeyup="formatValue(this)" type="text" class="form-control into_money_format validate" readonly>
                                            <input type="hidden" name="into_money[]" value="" class="form-control into_money">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class="required">Loại máy</label>
                                            <select name="machine_id[]" data-placeholder="Chọn loại máy" class="machine_id select-search form-control select validate" data-fouc>
                                                {!! $machine_html !!}
                                            </select>
                                        </div>

                                        <div class="col-md-1 btn-product">
                                            <button type="button" class="btn btn-primary btn-danger btn_delete" style="margin-top:27px;"><i class="icon-cancel-square"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top-1 mb-1 pt-1">
                                    <div class="col-md-12 text-right">
                                        <h5>Tổng: <span class="total"></span></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left col-md-3">
                                        <button type="button" class="btn btn-primary" id="btn_add"> Thêm sản phẩm</button>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-left mt-4 ">
                                <a type="button" href="{{route('admin.order.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                <input type="submit" class="btn btn-primary legitRipple" value="Lưu lại">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

    <script src="{!! asset('assets/backend/js/custom.js') !!}"></script>
    <script>
        $('#btn_add').click(function (){
            $('.product').append(`
                 <div class="row border-top-1 mb-1 pt-3 item" >
                        <div class="form-group col-md-2 d-none">
                            <label class="required">SKU</label>
                            <input name="sku[]" value="{!! old('sku') !!}" type="text" class="form-control validate">

                        </div>
                        <div class="form-group col-md-2">
                            <label class="required">Mã khuôn</label>
                            <select name="pattern_id[]" data-placeholder="Chọn mã khuôn" class="pattern_id select-search form-control select validate" data-fouc>
                {!! $pattern_html !!}
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="required">Mã linh kiện</label>
                            <select name="accessory_id[]" data-placeholder="Chọn linh kiện" class="accessory_id select-search form-control select validate" data-fouc>

                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="required">Tên linh kiện</label>
                            <input name="" value="" type="text" class="accessory_name form-control validate" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="required">Chất liệu</label>
                            <select name="material_id[]" data-placeholder="Chọn chất liệu" class="material_id select-search form-control select validate" data-fouc>
                {!! $material_html !!}
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="required">Màu</label>
                            <select name="color_id[]" data-placeholder="Chọn màu" class="material_color select-search form-control select validate" data-fouc>
                {!! $color_html !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <label class="required">TL (mỗi bìa)</label>
                            <input name="weight_b[]" readonly type="text" class="weight_b form-control validate">
                        </div>
                        <div class="form-group col-md-1">
                            <label class="required">TL (mỗi cái)</label>
                            <input name="weight_c[]" readonly type="text" class="weight_c form-control validate">
                        </div>
                        <div class="form-group col-md-1">
                            <label class="required">Lỗ khuôn</label>
                            <input name="pattern[]" type="number" min="0" class="form-control pattern" readonly>
                        </div>
                        <div class="form-group col-md-1">
                            <label class="required">Chu kì</label>
                            <input name="period[]" type="text" class="form-control period validate" >
                        </div>
                        <div class="form-group col-md-1">
                            <label class="required">SLYC</label>
                            <input id="quantity[]" autocomplete="off" onkeyup="formatValue(this)" type="text" class="form-control quantity_format validate" value="">
                            <input type="hidden" name="quantity[]" value="" class="form-control quantity">
                        </div>
                        <div class="form-group col-md-1">
                            <label class="required">Đơn giá</label>
                            <input id="price[]" autocomplete="off" onkeyup="formatValue(this)" type="text" class="form-control price_format validate" value="">
                            <input type="hidden" name="price[]" value="" class="form-control price ">

                        </div>
                        <div class="form-group col-md-2">
                            <label class="required">Thành tiền</label>
                            <input id="into_money[]" autocomplete="off" onkeyup="formatValue(this)" type="text" class="form-control into_money_format validate" readonly>
                            <input type="hidden" name="into_money[]" value="" class="form-control into_money">
                        </div>

                        <div class="form-group col-md-2">
                            <label class="required">Loại máy</label>
                            <select name="machine_id[]" data-placeholder="Chọn loại máy" class="machine_id select-search form-control select validate" data-fouc>
                {!! $machine_html !!}
                            </select>
                        </div>

                        <div class="col-md-1 btn-product">
                            <button type="button" class="btn btn-primary btn-danger btn_delete" style="margin-top:27px;"><i class="icon-cancel-square"></i> </button>
                        </div>
                    </div>
`);
            $('.select').select2();
        })
        $('.card-body').delegate('.btn_delete', 'click', function () {
            $(this).parent().parent().remove();
        })

        $('.card-body').delegate('.pattern_id', 'change', function () {
            var pattern_id = $(this).val();
            $this = $(this);
            $.ajax({
                url: '/api/getAccessory',
                method: 'POST',
                data: {pattern_id: pattern_id},
                success: function (response) {
                    if (response.error == false) {
                        $this.parents('.item').find('.accessory_id').html(response.html);
                        $this.parents('.item').find('.pattern').val(response.quantity);
                        $this.parents('.item').find('.weight_b').val(response.pattern_weight);
                    }
                    $('select').select2();
                }
            });
        })
        $('.card-body').delegate('.accessory_id', 'change', function () {
            var accessory_id = $(this).val();
            var pattern_id = $(this).parents('.item').find('.pattern_id').val();
            $this = $(this);
            $.ajax({
                url: '/api/getInfoAccessory',
                method: 'POST',
                data: {accessory_id: accessory_id, pattern_id:pattern_id},
                success: function (response) {
                    if (response.error == false) {
                        // $this.parents('.item').find('.capacity').val(response.quantity);
                        $this.parents('.item').find('.accessory_name').val(response.name);
                        $this.parents('.item').find('.weight_c').val(response.weight_c);
                    }
                    $('select').select2();
                }
            });
        })

    </script>
@stop
