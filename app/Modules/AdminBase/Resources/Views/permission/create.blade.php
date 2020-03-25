@extends('AdminBase::base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加权限</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.permission.store')}}" method="post">
                @include('AdminBase::permission._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('AdminBase::permission._js')
@endsection
