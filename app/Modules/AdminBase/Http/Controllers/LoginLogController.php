<?php

namespace App\Modules\AdminBase\Http\Controllers;

use App\Models\AdminBase\Option;
use App\Models\AdminBase\LoginLog;
use Illuminate\Http\Request;
use App\Modules\AdminBase\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class LoginLogController extends Controller
{
    /**
     * 登录日志主页
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('AdminBase::log.login');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $data = $request->all(['created_at', 'username']);

        $model = LoginLog::when($data['username'], function ($query, $data) {
            return $query->where('username', 'like', '%' . $data['username'] . '%');
        });

        // 创建时间
        if (!empty($data['created_at'])) {
            // 分离时间段
            list($start, $end) = explode(' - ', $data['created_at']);
            $model = $model->when($start, function ($query) use ($start) {
                return $query->where('created_at', '>=', "{$start} 00:00:00");
            })->when($end, function ($query) use ($end) {
                return $query->where('created_at', '<=', "{$end} 23:59:59");
            });
        }

        // 分页查询
        $model = $model->orderBy('id', 'desc')->paginate($request->get('limit', 30));
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $model->total(),
            'data' => $model->items(),
        ];
        return Response::json($data);
    }

    /**
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (!is_array($ids) || empty($ids)) {
            return Response::json(['code' => 1, 'msg' => '请选择删除项']);
        }

        if (empty(adminConfig('delete_login_log'))) {
            return Response::json(['code' => 1, 'msg' => '系统已设置禁止删除登录日志']);
        }
        try {
            LoginLog::destroy($ids);
            return Response::json(['code' => 0, 'msg' => '删除成功']);
        } catch (\Exception $exception) {
            return Response::json(['code' => 1, 'msg' => '删除失败', 'data' => $exception->getMessage()]);
        }
    }

}
