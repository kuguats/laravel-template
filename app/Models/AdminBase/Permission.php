<?php

namespace App\Models\AdminBase;

use Illuminate\Support\Arr;

class Permission extends \Spatie\Permission\Models\Permission
{

    protected $appends = ['type_name'];

    public function getTypeNameAttribute()
    {
        return $this->attributes['type_name'] = Arr::get([1 => '按钮', 2 => '菜单'], $this->type);
    }

    //子权限
    public function childs()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }

    //所有子权限递归
    public function children()
    {
        return $this->childs()->with('children');
    }

    /* ============================================================
     * 统一调用权限变量
     * ============================================================ */
    // 系统用户模块
    const MODULE_USER = 'user';
    // 用户
    const USER = 'user.user';
    const USER_CREATE = 'user.user.create';
    const USER_EDIT = 'user.user.edit';
    const USER_DESTROY = 'user.user.destroy';
    const USER_ROLE = 'user.user.role';
    const USER_PERMISSION = 'user.user.permission';
    // 角色
    const ROLE = 'user.role';
    const ROLE_CREATE = 'user.role.create';
    const ROLE_EDIT = 'user.role.edit';
    const ROLE_DESTROY = 'user.role.destroy';
    const ROLE_PERMISSION = 'user.role.permission';
    // 权限
    const PERMISSION = 'user.permission';
    const PERMISSION_CREATE = 'user.permission.create';
    const PERMISSION_EDIT = 'user.permission.edit';
    const PERMISSION_DESTROY = 'user.permission.destroy';

    // 系统管理模块
    const MODULE_SYSTEM = 'system';
    // 配置组
    const OPTION_GROUP = 'system.option_group';
    const OPTION_GROUP_CREATE = 'system.option_group.create';
    const OPTION_GROUP_EDIT = 'system.option_group.edit';
    const OPTION_GROUP_DESTROY = 'system.option_group.destroy';
    // 配置项
    const OPTION = 'system.option';
    const OPTION_CREATE = 'system.option.create';
    const OPTION_EDIT = 'system.option.edit';
    const OPTION_DESTROY = 'system.option.destroy';
    // 登录日志
    const LOGIN_LOG = 'system.login_log';
    const LOGIN_LOG_DESTROY = 'system.login_log.destroy';
}
