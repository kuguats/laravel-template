<?php

use App\Models\AdminBase\Permission;

?>

@extends('AdminBase::base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-inline">
                @can(Permission::OPTION_CREATE)
                    <a class="layui-btn" href="{{ route('admin.option.create') }}">添加</a>
                @endcan
            </div>
        </div>
        <div class="layui-card-body">
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    @foreach($groups as $group)
                        <li @if($loop->index==0) class="layui-this" @endif >{{$group->name}}</li>
                    @endforeach
                </ul>
                <div class="layui-tab-content">
                    @foreach($groups as $group)
                        <div class="layui-tab-item @if($loop->index==0) layui-show @endif">
                            <form class="layui-form">
                                @foreach($group->options as $option)
                                    <div class="layui-form-item">
                                        <label for="" class="layui-form-label"
                                               style="width: 120px">{{$option->label}}</label>
                                        <div class="layui-input-inline" style="min-width: 600px">
                                            @switch($option->type)
                                                @case('input')
                                                <input type="input" class="layui-input" name="{{$option->key}}"
                                                       value="{{$option->val}}">
                                                @break
                                                @case('textarea')
                                                <textarea name="{{$option->key}}"
                                                          class="layui-textarea">{{$option->val}}</textarea>
                                                @break
                                                @case('select')
                                                <select name="{{$option->key}}">
                                                    @if($option->content)
                                                        @foreach(explode("|",$option->content) as $v)
                                                            @php
                                                                $key = \Illuminate\Support\Str::before($v,':');
                                                                $val = \Illuminate\Support\Str::after($v,':');
                                                            @endphp
                                                            <option value="{{$key}}"
                                                                    @if($key==$option->val) selected @endif >{{$val}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @break
                                                @case('radio')
                                                @if($option->content)
                                                    @foreach(explode("|",$option->content) as $v)
                                                        @php
                                                            $key = \Illuminate\Support\Str::before($v,':');
                                                            $val = \Illuminate\Support\Str::after($v,':');
                                                        @endphp
                                                        <input type="radio" name="{{$option->key}}" value="{{$key}}"
                                                               @if($key==$option->val) checked @endif title="{{$val}}">
                                                    @endforeach
                                                @endif
                                                @break
                                                @case('image')
                                                <div class="layui-upload">
                                                    <button type="button" class="layui-btn uploadPic"><i
                                                            class="layui-icon">&#xe67c;</i>图片上传
                                                    </button>
                                                    <div class="layui-upload-list">
                                                        <ul class="layui-upload-box layui-clear">
                                                            @if($option->val)
                                                                <li><img src="{{ $option->val }}"/>
                                                                    <p>上传成功</p></li>
                                                            @endif
                                                        </ul>
                                                        <input type="hidden" class="layui-upload-input"
                                                               name="{{$option->key}}" value="{{$option->val}}">
                                                    </div>
                                                </div>
                                                @break
                                                @default
                                                @break
                                            @endswitch
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">{{$option->tips}}</div>
                                    </div>
                                @endforeach
                                <div class="layui-form-item">
                                    <div class="layui-inline">
                                        <button type="submit" class="layui-btn" lay-submit lay-filter="option_group">确
                                            认
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @can(Permission::OPTION)
        <script>
            layui.use(['layer', 'table', 'form', 'upload', 'element'], function () {
                var $ = layui.jquery;
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                var upload = layui.upload;

                //图片
                $(".uploadPic").each(function (index, elem) {
                    upload.render({
                        elem: $(elem)
                        , url: '{{ route("admin.option.upload") }}'
                        , multiple: false
                        , data: {"_token": "{{ csrf_token() }}"}
                        , done: function (res) {
                            //如果上传失败
                            if (res.code == 0) {
                                layer.msg(res.msg, {icon: 1}, function () {
                                    $(elem).parent('.layui-upload').find('.layui-upload-box').html('<li><img src="' + res.url + '" /><p>上传成功</p></li>');
                                    $(elem).parent('.layui-upload').find('.layui-upload-input').val(res.url);
                                })
                            } else {
                                layer.msg(res.msg, {icon: 2})
                            }
                        }
                    });
                })

                //提交
                form.on('submit(option_group)', function (data) {
                    var parm = data.field;
                    parm['_method'] = 'put';
                    var load = layer.load();
                    $.post("{{route('admin.option.update')}}", data.field, function (res) {
                        layer.close(load);
                        if (res.code == 0) {
                            layer.msg(res.msg, {icon: 1})
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    });
                    return false;
                });
            })
        </script>
    @endcan
@endsection
