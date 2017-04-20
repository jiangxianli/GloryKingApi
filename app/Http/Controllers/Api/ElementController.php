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
}
