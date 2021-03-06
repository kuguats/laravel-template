@extends('AdminBase::base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>分配直接权限，直接权限与角色拥有的角色权限可叠加</h2>
        </div>
        <div class="layui-card-body">
            <form action="{{route('admin.user.assignPermission',['id'=>$user->id])}}" method="post" class="layui-form">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">帐号</label>
                    <div class="layui-word-aux layui-form-mid">{{ $user->username }}</div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">昵称</label>
                    <div class="layui-word-aux layui-form-mid">{{ $user->nickname }}</div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">手机</label>
                    <div class="layui-word-aux layui-form-mid">{{ $user->phone }}</div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">邮箱</label>
                    <div class="layui-word-aux layui-form-mid">{{ $user->email }}</div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">权限</label>
                    <div class="layui-inline">
                        @forelse($permissions as $p1)
                            <dl class="cate-box">
                                <dt>
                                    <div class="cate-first"><input id="menu{{$p1->id}}" type="checkbox" name="permissions[]" value="{{$p1->id}}" title="{{$p1->display_name}}" lay-skin="primary" {{$p1->own??''}} ></div>
                                </dt>
                                @if($p1->childs->isNotEmpty())
                                    @foreach($p1->childs as $p2)
                                        <dd>
                                            <div class="cate-second"><input id="menu{{$p1->id}}-{{$p2->id}}" type="checkbox" name="permissions[]" value="{{$p2->id}}" title="{{$p2->display_name}}" lay-skin="primary" {{$p2->own??''}}></div>
                                            @if($p2->childs->isNotEmpty())
                                                <div class="cate-third">
                                                    @foreach($p2->childs as $p3)
                                                        <input type="checkbox" id="menu{{$p1->id}}-{{$p2->id}}-{{$p3->id}}" name="permissions[]" value="{{$p3->id}}" title="{{$p3->display_name}}" lay-skin="primary" {{$p3->own??''}}>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </dd>
                                    @endforeach
                                @endif
                            </dl>
                        @empty
                            <div style="text-align: center;padding:20px 0;">
                                无数据
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label"></label>
                    <div class="layui-inline">
                        <button type="submit" class="layui-btn" lay-submit="" >确 认</button>
                        <a href="{{route('admin.user')}}"  class="layui-btn" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        layui.use(['layer','table','form'],function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            form.on('checkbox', function (data) {
                var check = data.elem.checked;//是否选中
                var checkId = data.elem.id;//当前操作的选项框
                if (check) {
                    //选中
                    var ids = checkId.split("-");
                    if (ids.length == 3) {
                        //第三极菜单
                        //第三极菜单选中,则他的上级选中
                        $("#" + (ids[0] + '-' + ids[1])).prop("checked", true);
                        $("#" + (ids[0])).prop("checked", true);
                    } else if (ids.length == 2) {
                        //第二季菜单
                        $("#" + (ids[0])).prop("checked", true);
                        $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                            $(ele).prop("checked", true);
                        });
                    } else {
                        //第一季菜单不需要做处理
                        $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                            $(ele).prop("checked", true);
                        });
                    }
                } else {
                    //取消选中
                    var ids = checkId.split("-");
                    if (ids.length == 2) {
                        //第二极菜单
                        $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                            $(ele).prop("checked", false);
                        });
                    } else if (ids.length == 1) {
                        $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                            $(ele).prop("checked", false);
                        });
                    }
                }
                form.render();
            });
        });

    </script>
@endsection

