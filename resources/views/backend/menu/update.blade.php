@extends('backend.layouts.master')
@section('content')
<div class="content">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Cập nhật</h5>
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
                    <form action="{!!route('admin.menu.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Chọn page</label>
                                <div class="col-md-7">
                                    <select name="page_id" data-placeholder="Chọn page" class="form-control select select-search" multiple="" data-fouc >
                                        {!! $page_html !!}
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="menu-detail">
                                @foreach($record->menuDetail as $detail)
                                <div class="form-group row">
                                    <div class="col-md-3 row">
                                        <label class="col-md-2 col-form-label text-right">Tên</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="name[]" value="{!!$detail->name!!}">
                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-7 row">
                                        <label class="col-md-1 col-form-label text-right">Link </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control alias-product" name="link[]" value="{!!$detail->link!!}">
                                            {!! $errors->first('link', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-2 btn-product">
                                        <button type="button" class="btn btn-primary btn-primary btn-add-menu" style="margin-right: 2px;" title="Copy"><i  class="icon-copy2"></i> </button>
                                        <button type="button" class="btn btn-primary btn-danger btn-delete-menu" ><i class="icon-cancel-square"></i> </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                        <div class="text-right row">
                            <div class="col-md-9">
                                <a type="button" href="{{route('admin.menu.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
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
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/form_select2.js') !!}"></script>
<script>
    $('[name="name"]').change(function () {
        let name = $(this).val();
        $.ajax({
            url:'/api/getPlugByName',
            method:'post',
            data:{name:name},
            success:function (response) {
                $('[name="alias"]').val(response.alias);
                $('[name="alias"]').attr('value',response.alias);
            }
        })
    })
    $('.card-body').delegate('.btn-add-menu','click', function () {
        $('.menu-detail').append(' <div class="form-group row">' +
            '                                    <div class="col-md-3 row">' +
            '                                        <label class="col-md-2 col-form-label text-right">Tên</label>' +
            '                                        <div class="col-md-7">' +
            '                                            <input type="text" class="form-control" name="name[]" value="">' +
            '                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}' +
            '                                        </div>' +
            '                                    </div>' +
            '                                    <div class="col-md-7 row">' +
            '                                        <label class="col-md-1 col-form-label text-right">Link </label>' +
            '                                        <div class="col-md-10">' +
            '                                            <input type="text" class="form-control alias-product" name="link[]" value="">' +
            '                                            {!! $errors->first('link', '<span class="text-danger">:message</span>') !!}' +
            '                                        </div>' +
            '                                    </div>' +
            '                                    <div class="col-md-2 btn-product">' +
            '                                        <button type="button" class="btn btn-primary btn-primary btn-add-menu" style="margin-right: 2px;" title="Copy"><i  class="icon-copy2"></i> </button>' +
            '                                        <button type="button" class="btn btn-primary btn-danger btn-delete-menu" ><i class="icon-cancel-square"></i> </button>' +
            '                                    </div>' +
            '                                </div>')
    });
    $('.card-body').delegate('.btn-delete-menu','click', function () {
        $(this).parent().parent().remove();
    })
</script>
@stop
