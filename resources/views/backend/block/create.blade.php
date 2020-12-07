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
                        <form action="{!!route('admin.block.store')!!}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Body</label>
                                    <div class="col-md-7">
                                        <select name="body_id" data-placeholder="Chọn body" class="form-control select select-search" data-fouc >
                                            {!!$body_html!!}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Kiểu</label>
                                    <div class="col-md-5 row">
                                        <div class="col-md-12">
                                            <select name="type" id="type_block" data-placeholder="Chọn kiểu" class="form-control select select-search" data-fouc >
                                                <option></option>
                                                <option value="1">Hình ảnh</option>
                                                <option value="2">Video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự</label>
                                        <div class="col-md-5">
                                            <input type="number" name="order_by" class="form-control" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row result-type">
                                </div>
                                <div class="row">
                                    <label class="col-md-6 col-form-label text-left">Tiêu đề </label>
                                    <label class="col-md-6 col-form-label text-left">Mô tả </label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea class="form-control ckeditor" id="title" name="title">{!!old('title')!!}</textarea>
                                            </div>
                                        </div></div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea class="form-control ckeditor" id="description" name="description">{!!old('description')!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h2 class="text-center">Chi tiết từng khối</h2>
                            <div class="row">
                                @for($i=1;$i <= 6; $i++)
                                <div class="col-md-6">
                                    <fieldset>
                                        <h3 class="text-center">Khối {{$i}}</h3>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Ảnh <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                                <input type="file" class="file-input" name="detail_image[]" data-fouc>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Tiêu đề </label>
                                            <div class="form-group col-md-7">
                                                <input id="detail_title" type="text" name="detail_title[]" class="form-control validate">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Mô tả </label>
                                            <div class="form-group col-md-7">
                                                <textarea id="detail_description" name="detail_description[]" class="form-control validate" cols="3"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                @endfor
                            </div>

                            <div class="text-right row">
                                <div class="col-md-9">
                                    <a type="button" href="{{route('admin.block.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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
    <script>
        $(document).ready(function() {
            $('[name="size_id"]').select2();
        });
        $('#type_block').change(function () {
            let type = $(this).val();
            $.ajax({
                url:'/api/getHtmlTypeBlock',
                method:'post',
                data:{type:type},
                success:function (response) {
                    $('.result-type').html(response.html);
                    $(".file-input").fileinput();
                }
            })
        })
    </script>
@stop
