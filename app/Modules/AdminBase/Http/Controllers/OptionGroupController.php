<?php

namespace App\Modules\AdminBase\Http\Controllers;

use App\Modules\AdminBase\Http\Requests\OptionGroupRequest;
use Illuminate\Http\Request;
use App\Modules\AdminBase\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\AdminBase\OptionGroup;
use Illuminate\Support\Facades\DB;

class OptionGroupController extends Controller
{
    /**
     * 标签列表
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('AdminBase::option_group.index');
    }

    /**
     * 标签数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {

        $res = OptionGroup::orderBy('sort','asc')->orderBy('id','desc')->paginate($request->get('limit',30));
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items(),
        ];
        return Response::json($data);
    }

    /**
     * 添加标签
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('AdminBase::option_group.create');
    }

    /**
     * 添加标签
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(OptionGroupRequest $request)
    {
        $data = $request->all(['name','sort']);
        try{
            OptionGroup::create($data);
            return Redirect::to(URL::route('admin.option_group'))->with(['success'=>'更新成功']);
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 更新标签
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $option_group = OptionGroup::findOrFail($id);
        return view('AdminBase::option_group.edit',compact('option_group'));
    }

    /**
     * 更新标签
     * @param OptionGroupRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OptionGroupRequest $request, $id)
    {
        $option_group = OptionGroup::findOrFail($id);
        $data = $request->all(['name','sort']);
        try{
            $option_group->update($data);
            return Redirect::to(URL::route('admin.option_group'))->with(['success'=>'更新成功']);
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('更新失败');
        }
    }

    /**
     * 删除标签
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (!is_array($ids) || empty($ids)){
            return Response::json(['code'=>1,'msg'=>'请选择删除项']);
        }
        $group = OptionGroup::with('options')->find($ids[0]);
        if ($group->options->isNotEmpty()){
            return Response::json(['code'=>1,'msg'=>'该组存在配置项，禁止删除']);
        }
        try{
            $group->delete();
            return Response::json(['code'=>0,'msg'=>'删除成功']);
        }catch (\Exception $exception){
            return Response::json(['code'=>1,'msg'=>'删除失败','data'=>$exception->getMessage()]);
        }
    }
}
