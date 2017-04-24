<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GloryKing\Handler\AdminHandler;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    /**
     * 元素列表页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-24 19:10:47
     */
    public function getIndex(Request $request)
    {
        $params = $request->all();

        $element = AdminHandler::getElements(array_merge($params, ['by' => 'all']));

//        dd($element);

        return view('admin.element.index', compact('element'));
    }

    /**
     * 添加元素页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-24 18:35:34
     */
    public function getAddElement(Request $request)
    {
        $params = $request->all();

        $hero = AdminHandler::getHeroList(array_merge($params, ['by' => 'all_hero']));

        return view('admin.element.add', compact('hero'));
    }

    /**
     * 添加元素
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-24 18:35:50
     */
    public function postAddElement(Request $request)
    {
        $params = $request->all();

        $response = AdminHandler::elementOperate($params, 'add');

        return response()->json($response);
    }
}
