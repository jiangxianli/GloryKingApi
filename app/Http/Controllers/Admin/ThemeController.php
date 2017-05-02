<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GloryKing\Handler\AdminHandler;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * 专题列表页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-24 19:10:47
     */
    public function getIndex(Request $request)
    {
        $params = $request->all();

        $params['by'] = 'all';
        $theme        = AdminHandler::getThemeList($params);

        return view('admin.theme.index', compact('theme'));
    }

    /**
     * 添加专题页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-28 11:44:43
     */
    public function getAddTheme(Request $request)
    {
        return view('admin.theme.add');
    }

    /**
     * 添加专题操作
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-28 11:44:56
     */
    public function postAddTheme(Request $request)
    {
        $params = $request->all();

        $response = AdminHandler::themeOperate($params, 'add');

        return response()->json($response);
    }

    /**
     * 编辑专题页面
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-05-02 11:07:21
     */
    public function getEditTheme(Request $request, $id)
    {
        $params = $request->all();

        $params['by'] = 'id';
        $params['id'] = $id;
        $theme        = AdminHandler::getThemeList($params);

        return view('admin.theme.edit', compact('theme'));
    }

    /**
     * 编辑专题操作
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-05-02 11:16:53
     */
    public function postEditTheme(Request $request, $id)
    {
        $params = $request->all();

        $params['id'] = $id;
        $response     = AdminHandler::themeOperate($params, 'edit');

        return response()->json($response);
    }
}
