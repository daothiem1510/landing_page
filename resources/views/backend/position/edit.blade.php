
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
                <div class="col-md-10 col-md-offset-1">
                    <form action="{!!route('admin.position.update', $record->id)!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tên chức danh <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" value="{!!old('name')?:$record->name!!}" required="">
                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-check col-md-4 form-check-right">
                                    <label class="form-check-label float-right">
                                        Kích hoạt
                                        <div class=""><span><input type="checkbox" class="form-check-input-styled" {{($record->status == 1)?'checked':''}} name="status" data-fouc=""></span></div>
                                    </label>
                                </div>
                            </div>

                        </fieldset>
                        <div class="text-right form-group">
                            <a type="button" href="{{route('admin.position.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
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


<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>


<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

@stop
