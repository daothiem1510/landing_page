@extends('backend.layouts.master')
@section('content')
    <div class="content department">
        <div class="row">
            <div class="col-sm-8 offset-md-2">
                <div class="row">
                    <div class="col-sm-4">
                        @if(in_array('admin.customer.index', explode(',', \Auth::user()->role->route)) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                            <a href="{{route('admin.customer.index')}}">
                                <div class="card text-center border">
                                    <div class="card-body">
                                        <img src="{!! asset('img/sale.png') !!}" class="icon">
                                        <h4>Khách hàng</h4>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="card text-center border no-active">
                                <div class="card-body">
                                    <img src="{!! asset('img/sale.png') !!}" class="icon">
                                    <h4>Khách hàng</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        @if(in_array('admin.order.index', explode(',', \Auth::user()->role->route)) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                            <a href="{{route('admin.order.index')}}">
                                <div class="card text-center border">
                                    <div class="card-body">
                                        <img src="{!! asset('img/accounting.png') !!}" class="icon">
                                        <h4>Đơn hàng</h4>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="card text-center border no-active">
                                <div class="card-body">
                                    <img src="{!! asset('img/accounting.png') !!}" class="icon">
                                    <h4>Đơn hàng</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        @if(in_array('admin.product.index', explode(',', \Auth::user()->role->route)) || Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR)
                            <a href="{{route('admin.product.index')}}">
                                <div class="card text-center border">
                                    <div class="card-body">
                                        <img src="{!! asset('img/accounting.png') !!}" class="icon">
                                        <h4>Sản phẩm</h4>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="card text-center border no-active">
                                <div class="card-body">
                                    <img src="{!! asset('img/accounting.png') !!}" class="icon">
                                    <h4>Đơn hàng</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
@stop
@section('script')
    @parent
    <script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/core.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/effects.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/demo_pages/jqueryui_components.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') !!}"></script>

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
    <script src="{!! asset('assets/backend/js/custom.js') !!}"></script>
    <script src="{!! asset('assets/backend/js/editable.min.js') !!}"></script>
    <script src="{!! asset('assets/global_assets/js/plugins/notifications/sweet_alert.min.js') !!}"></script>



@stop
