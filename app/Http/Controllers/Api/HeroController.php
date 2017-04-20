<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * 获取英雄列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-20 18:06:13
     */
    public function postHeroList(Request $request)
    {
        $params = $request->all();

        $response = ApiHandler::getHeroList($params);

        return response()->json($response);
    }
}
