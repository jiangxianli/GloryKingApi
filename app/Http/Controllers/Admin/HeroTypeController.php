<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class HeroTypeController extends Controller
{
    /**
     * 添加英雄类型页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-21 10:58:09
     */
    public function getAdd(Request $request)
    {
        return view('admin.hero_type.add');
    }

    /**
     * 添加英雄类型
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-21 16:04:28
     */
    public function postAdd(Request $request)
    {
        $params = $request->all();

        $response = ApiHandler::heroTypeOperate($params, 'add');

        return response()->json($response);
    }
}
