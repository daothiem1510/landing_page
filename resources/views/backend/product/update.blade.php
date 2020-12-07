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
                    <form action="{!!route('admin.product.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Tên sản phẩm </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="name" value="{!!old('name')?:$record->name!!}">
                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Alias </label>
                                <div class="col-md-7">
                                    <input type="text" readonly class="form-control alias-product" name="alias" value="{!!old('alias')?:$record->alias!!}">
                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Màu</label>
                                <div class="col-md-7">
                                    <select name="color_id" data-placeholder="Chọn màu" class="form-control select select-search" multiple="" data-fouc >
                                        {!!$color_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Size</label>
                                <div class="col-md-7">
                                    <select name="size_id[]" data-placeholder="Chọn size" class="form-control select select-search" multiple="" data-fouc >
                                        {!! $size_html !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Đơn giá </label>
                                <div class="form-group col-md-7">
                                    <input id="price" type="text" onkeyup="formatValue(this)" class="form-control validate price_format" value="{{number_format($record->price)}}">
                                    <input name="price" type="hidden" class="form-control price" value="{{$record->price}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Loại sản phẩm</label>
                                <div class="col-md-7">
                                    <select name="category_id" data-placeholder="Chọn loại sản phẩm" class="form-control select select-search" multiple="" data-fouc >
                                        {!! $category_html !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Ảnh sản phẩm <span class="text-danger">*</span></label>
                                <div class="col-md-7 div-image">
                                    <input type="file"  id="image" multiple="" name="image" class="file-input-extensions" data-field="file">
                                    <input type="hidden" class="image_data" name="old_image" value="{!!is_null(old('image'))?$record->image:old('image')!!}" required=""/>
                                    {!! $errors->first('degree', '<span class="text-danger">:message</span>') !!}
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
