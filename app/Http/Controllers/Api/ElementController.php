<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    /**
     * 获取素材列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-20 18:07:32
     */
    public function postElementList(Request $request)
    {
        $params = $request->all();

        $response = ApiHandler::getElementList($params);

        return response()->json($response);
    }

    /**
     * 素材操作
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-26 16:06:11
     */
    public function postElementOperate(Request $request)
    {
        $params = $request->all();

        $response = ApiHandler::elementOperate($params);

        return response()->json($response);
    }
}
