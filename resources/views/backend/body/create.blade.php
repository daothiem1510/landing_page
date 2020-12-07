@include('ckfinder::setup')
@extends('backend.layouts.master')
@section('content')
    <div class="content">
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
                <div class="row">
                    <div class="col-md-12">
                        <form action="{!!route('admin.body.store')!!}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Chọn page</label>
                                    <div class="col-md-7">
                                        <select name="page_id" data-placeholder="Chọn page" class="form-control select select-search" data-fouc >
                                            {!! $page_html !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 col-form-label text-right">Tên</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="name" value="{!!old('name')!!}">
                                        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-right row">
                                <div class="col-md-9">
                                    <a type="button" href="{{route('admin.body.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
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
    </script>
@stop
