<?php

namespace App\Modules\AdminBase\Http\Controllers;

use App\Models\AdminBase\Role;
use App\Models\AdminBase\User;
use App\Modules\AdminBase\Http\Requests\PermissionCreateRequest;
use App\Modules\AdminBase\Http\Requests\PermissionUpdateRequest;
use Illuminate\Http\Request;
use App\Modules\AdminBase\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\AdminBase\Permission;

class PermissionController extends Controller
{
    /**
     * 权限列表
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('AdminBase::permission.index');
    }

    /**
     * 权限数据表格
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $res = Permission::get();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->count(),
            'data' => $res
        ];
        return Response::json($data);
    }

    /**
     * 添加权限
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = Permission::with('children')->where('parent_id', 0)->get();
        return view('AdminBase::permission.create', compact('permissions'));
    }

    /**
     * 添加权限
     * @param PermissionCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionCreateRequest $request)
    {
        $data = $request->all();
        try {
            $permission = Permission::create($data);

            // 默认赋予超级管理员角色新权限
            $role = Role::where('name', 'root')->first();
            if (!empty($role)) $role->givePermissionTo($permission->name);

            // 默认赋予超级管理员下用户新权限
            $users = User::role('root')->get();
            foreach ($users as $user) $user->givePermissionTo($permission->name);

            return Redirect::to(URL::route('admin.permission'))->with(['success' => '添加成功']);
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 更新权限
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $permissions = Permission::with('children')->where('parent_id', 0)->get();
        return view('AdminBase::permission.edit', compact('permission', 'permissions'));
    }

    /**
     * 更新权限
     * @param PermissionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $data = $request->all();
        try {
            $permission->update($data);
            return Redirect::to(URL::route('admin.permission'))->with(['success' => '更新成功']);
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('更新失败');
        }
    }

    /**
     * 删除权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (!is_array($ids) || empty($ids)) {
            return Response::json(['code' => 1, 'msg' => '请选择删除项']);
        }
        $permission = Permission::with('childs')->find($ids[0]);
        if (!$permission) {
            return Response::json(['code' => 1, 'msg' => '权限不存在']);
        }
        //如果有子权限，则禁止删除
        if ($permission->childs->isNotEmpty()) {
            return Response::json(['code' => 1, 'msg' => '存在子权限禁止删除']);
        }
        try {
            $permission->delete();
            return Response::json(['code' => 0, 'msg' => '删除成功']);
        } catch (\Exception $exception) {
            return Response::json(['code' => 0, 'msg' => '存在子权限禁止删除']);
        }
    }
}
