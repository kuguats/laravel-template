<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    //后台布局
    public function layout()
    {
        $menus = \App\Models\Permission::with(['childs'])->where('parent_id', 0)->orderBy('sort', 'desc')->get();
        return View::make('admin.layout', compact('menus'));
    }

    public function index()
    {
        return View::make('admin.index.index');
    }
}
