
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
                    <form action="{!!route('admin.staff.update', $record->id)!!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Số thẻ <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="code" value="{!!old('code')?:$record->code!!}" required="" readonly="">
                                    {!! $errors->first('code', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Họ tên <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="full_name" value="{!!old('full_name')?:$record->full_name!!}"  required="">
                                    {!! $errors->first('full_name', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Bộ phận <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="select-search form-control" name="department_id" data-placeholder="Chọn bộ phận" required>
                                        {!!$department_html!!}
                                    </select>
                                    {!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Chức vụ <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="select-search form-control" name="position_id" data-placeholder="Chọn chức vụ" required>
                                        {!!$position_html!!}
                                    </select>
                                    {!! $errors->first('position_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-semibold col-md-3 text-right">Giới tính <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" value="{{\App\Staff::MALE}}" class="form-check-input-styled" @if($record->gender == \App\Staff::MALE) checked @endif data-fouc>
                                               Nam
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" value="{{\App\Staff::FEMALE}}" class="form-check-input-styled" @if($record->gender == \App\Staff::FEMALE) checked @endif>
                                               Nữ
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-check-label col-md-3 text-right">Ngày sinh </label>
                                <div class="input-group col-md-9">
                                    <input type="date" class="form-control" placeholder="Ngày sinh" name="dob" value="{{$record->dob}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Điện thoại <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="phone" value="{!!old('phone')?:$record->phone!!}" required="">
                                    {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Địa chỉ <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address" value="{!!old('address')?:$record->address!!}" required="">
                                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Số chứng minh thư<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="identification" value="{!! old('identification') ?: $record->identification !!}">
                                    {!! $errors->first('identification', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Ngày cấp<span class="text-danger">*</span></label>
                                <div class="input-group col-md-9">
                                    <input type="date" class="form-control" name="identification_date" value="{!! old('identification_date') ?: $record->identification_date !!}">
                                    {!! $errors->first('identification_date', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Nơi cấp<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="identification_place" value="{!! old('identification_place') ?: $record->identification_place !!}">
                                    {!! $errors->first('identification_place', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Địa chỉ khai sinh<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address" value="{!!old('address')?: $record->address!!}" required="">
                                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Địa chỉ thường trú<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="permanent_address" value="{!!old('permanent_address')?: $record->permanent_address!!}" required="">
                                    {!! $errors->first('permanent_address', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Km<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="km" value="{!!old('km')?:$record->km!!}" required="">
                                    {!! $errors->first('km', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Trình độ học vấn<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="educational_level" value="{!!old('educational_level')?:$record->educational_level!!}" required="">
                                    {!! $errors->first('educational_level', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Bằng cấp <span class="text-danger">*</span></label>
                                <div class="col-md-9 div-image">
                                    <input type="file"  id="degree" multiple="" name="degree[]" class="file-input-extensions" data-field="file">
                                    <input type="hidden" class="image_data" name="old_degree" value="{!!is_null(old('degree'))?$record->degree:old('degree')!!}" required=""/>
                                    {!! $errors->first('degree', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Số sổ bảo hiểm xã hội<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="insuarance" value="{!!old('insuarance')?:$record->insuarance!!}">
                                    {!! $errors->first('insuarance', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Mã số thuế<span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="tax_code" value="{!!old('tax_code')?:$record->educational_level!!}" required="">
                                    {!! $errors->first('tax_code', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-check-label col-md-3 text-right">Ngày vào </label>
                                <div class="input-group col-md-9">
                                    <input type="date" class="form-control" placeholder="Ngày vào" name="start_date"  value="{{$record->start_date}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-check-label col-md-3 text-right">Ngày kí hợp đồng chính thức có thời hạn lần 1 </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="contract_level_1" value="{!!old('contract_level_1')?:$record->contract_level_1!!}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-check-label col-md-3 text-right">Ngày kí hợp đồng có thời hạn lần 2 </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="contract_level_2" value="{!!old('contract_level_2')?:$record->contract_level_2!!}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-check-label col-md-3 text-right">Ngày kí hợp đồng vô thời hạn </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="contract_level_3" value="{!!old('contract_level_3')?:$record->contract_level_3!!}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Giấy khám sức khỏe <span class="text-danger">*</span></label>
                                <div class="col-md-9 div-image">
                                    <input type="file"  id="file" multiple="" name="file[]" class="file-input-extensions" data-field="file">
                                    <input type="hidden" class="image_data" name="old_file" value="{!!is_null(old('file'))?$record->file:old('file')!!}" required=""/>
                                    {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check col-md-4 form-check-right">
                                    <label class="form-check-label float-right">
                                        Kích hoạt
                                        <input type="checkbox" class="form-check-input-styled"  name="status" {{($record->status == 1)?'checked':''}}>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.staff.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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
@stop
