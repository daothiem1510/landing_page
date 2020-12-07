
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
            @if (Session::has('success'))
            <div class="alert bg-success alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
            @endif
            <form action="{!!route('admin.user.update', $record->id)!!}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                <input type="hidden" name="role_id" value="{!!$record->role_id!!}" />
                <div class="panel panel-body results">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend class="text-semibold"><i class="icon-reading position-left"></i> Cập nhật</legend>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Tên đăng nhập</label>
                                        <input name="username" type="text" class="form-control" value="{!!!is_null(old('username'))?old('username'):$record->username!!}">
                                        {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Họ tên</label>
                                        <input name="name" type="text" class="form-control" value="{!!!is_null(old('name'))?old('name'):$record->name!!}">
                                        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>                    
                                <div class="form-group">
                                    <label class="required">Quyền</label>
                                    <select name="role_id" class="form-control select select-search">
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{$role->id==$record->role_id?'selected':''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('role_id', '<span class="text-danger">:message</span>') !!}
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
@stop

