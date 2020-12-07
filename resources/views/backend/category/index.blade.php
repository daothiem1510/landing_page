@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Danh mục sản phẩm</h5>
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
        </div>

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$record->name}}</td>
                    <td>@if($record->parents()->exists()){{$record->parents->name}}@endif</td>
                    <td>
                        @if($record->status == 1)
                        <span class="badge bg-success-400">Hiển thị</span>
                        @else
                        <span class="badge bg-grey-400">Ẩn</span>
                        @endif
                    </td>
                    <td>
                       {{$record->created_at()}}
                    </td>
                    <td class="text-center">
                        @if((in_array('admin.category.edit', \Auth::user()->role->route()) || \Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR))
                        <a href="{{route('admin.category.edit', $record->id)}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-penci/l"></i></a>
                        @endif
                        @if((in_array('admin.category.destroy', \Auth::user()->role->route()) || \Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR))
                            <form action="{!! route('admin.category.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <a title="{!! trans('base.delete') !!}" class="delete text-danger" data-action="delete">
                                <i class="icon-trash"></i>
                            </a>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /table header styling -->

</div>
<!-- /content area -->
@stop
@section('script')
@parent
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop
