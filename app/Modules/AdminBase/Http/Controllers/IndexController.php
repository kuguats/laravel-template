<?php

namespace App\Modules\AdminBase\Http\Controllers;

use App\Models\AdminBase\Permission;
use App\Modules\AdminBase\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    //后台布局
    public function layout()
    {
        $menus = Permission::with(['childs'])->where('parent_id', 0)->orderBy('sort', 'desc')->get();
        return view('AdminBase::layout', compact('menus'));
    }

    public function index()
    {
        return view('AdminBase::index.index');
    }
}
