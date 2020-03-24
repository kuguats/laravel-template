<?php

namespace App\Modules\Common\Http\Controllers;

use App\Modules\Common\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    //后台布局
    public function layout()
    {
        $menus = \App\Models\Permission::with(['childs'])->where('parent_id', 0)->orderBy('sort', 'desc')->get();
        return View::make('Common::layout', compact('menus'));
    }

    public function index()
    {
        return View::make('Common::index.index');
    }
}
