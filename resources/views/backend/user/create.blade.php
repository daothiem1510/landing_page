
@extends('backend.layouts.master')
@section('content')
<div class="content">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thành viên hệ thống</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{!!route('admin.user.store')!!}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                <div class="panel panel-body results">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-reading position-left"></i> Tạo mới</legend>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required col-md-3">Nhân viên</label>
                                        <div class="col-md-9">
                                            <select class="select-search form-control" name="staff_id" data-placeholder="Chọn nhân viên" required>
                                                {!! $staff_html !!}
                                            </select>
                                        </div>
                                        {!! $errors->first('staff_id', '<span class="text-danger">:message</span>') !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required col-md-3">Phân quyền</label>
                                        <select name="role_id" class="select-search form-control col-md-9">
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{$role->id==old('role_id')?'selected':''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('role_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="text-right form-group">
                        <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>

@stop

