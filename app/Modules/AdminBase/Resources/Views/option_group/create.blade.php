@extends('AdminBase::base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加配置组</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.option_group.store')}}" method="post">
                @include('AdminBase::option_group._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element','form'],function () {

        })
    </script>
@endsection
