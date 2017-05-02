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

        $params['by'] = 'all';
        $element      = AdminHandler::getElements($params);

        return view('admin.element.index', compact('element'));
    }

    /**
     * 搜索元素列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-28 13:36:25
     */
    public function searchElement(Request $request)
    {
        $params = $request->all();

        $params['by'] = 'all';
        $response     = AdminHandler::searchElement($params);

        return response()->json($response);
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

    /**
     * 编辑素材页面
     *
     * @param Request $request
     * @param $element_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-26 10:40:06
     */
    public function getEditElement(Request $request, $element_id)
    {
        $params = $request->all();

        $element = AdminHandler::getElements([
            'by' => 'detail',
            'id' => $element_id
        ]);

        $hero = AdminHandler::getHeroList(array_merge($params, ['by' => 'all_hero']));

        return view('admin.element.edit', compact('hero', 'element'));
    }

    /**
     * 更新素材
     *
     * @param Request $request
     * @param $element_id
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-26 10:45:32
     */
    public function postEditElement(Request $request, $element_id)
    {
        $params = $request->all();

        $params['id'] = $element_id;

        $response = AdminHandler::elementOperate($params, 'edit');

        return response()->json($response);
    }

    /**
     * 设置视频时长
     *
     * @param Request $request
     * @return \Library\ErrorMessage\ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-27 16:56:01
     */
    public function setElementDuration(Request $request)
    {
        $params = $request->all();

        $response = AdminHandler::elementOperate($params, 'set_duration');

        return $response;
    }
}
