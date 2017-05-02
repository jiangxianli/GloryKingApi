<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * 获取专题列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-05-02 11:27:45
     */
    public function postThemeList(Request $request)
    {
        $params = $request->all();

        $response = ApiHandler::getThemeList($params);

        return response()->json($response);
    }

}
