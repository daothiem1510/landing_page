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
                    <form action="{!!route('admin.page.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Chọn sản phẩm</label>
                                <div class="col-md-7">
                                    <select name="product_id" data-placeholder="Chọn sản phẩm" class="form-control select select-search" data-fouc >
                                        {!!$product_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Nhãn hiệu </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="brand" value="{!!old('brand')?:$record->brand!!}">
                                    {!! $errors->first('brand', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Tiêu đề </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="title" value="{!!old('title')?:$record->title!!}">
                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Ảnh page <span class="text-danger">*</span></label>
                                <div class="col-md-7 div-image">
                                    <input type="file"  id="image" multiple="" name="image" class="file-input-extensions" data-field="file">
                                    <input type="hidden" class="image_data" name="old_logo" value="{!!is_null(old('logo'))?$record->logo:old('image')!!}" required=""/>
                                    {!! $errors->first('logo', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Nội dung: </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control ckeditor" id="content" name="content">{!!old('content')?:$record->content!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="text-right row">
                            <div class="col-md-9">
                                <a type="button" href="{{route('admin.product.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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
@stop
