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

}
