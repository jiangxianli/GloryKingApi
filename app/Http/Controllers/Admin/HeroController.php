<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GloryKing\Handler\AdminHandler;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * 英雄列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-21 10:42:11
     */
    public function getHeroList(Request $request)
    {
        $params = $request->all();

        $hero_type_id = array_get($params, 'type_id', 0);

        $hero_type = AdminHandler::getAllHeroType($params);

        $params['per_page'] = array_get($params, 'per_page', 12);
        $params['by']       = 'type_id';
        $hero               = AdminHandler::getHeroList($params, 'type_id');

        return view('admin.hero.index', compact('hero_type_id', 'hero_type', 'hero'));
    }

    /**
     * 添加英雄页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-24 11:59:48
     */
    public function getAddHero(Request $request)
    {
        $params = $request->all();

        $hero_type = AdminHandler::getAllHeroType($params);

        return view('admin.hero.add', compact('hero_type'));
    }

    /**
     * 添加英雄
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-24 15:01:44
     */
    public function postAddHero(Request $request)
    {
        $params = $request->all();

        $response = ApiHandler::heroOperate($params, 'add');

        return response()->json($response);
    }

    /**
     * 编辑英雄界面
     *
     * @param Request $request
     * @param $hero_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiangxianli
     * @created_at 2017-04-24 16:43:59
     */
    public function getEditHero(Request $request, $hero_id)
    {
        $params = $request->all();

        //获取英雄信息
        $hero = AdminHandler::getHeroDetail($hero_id);

        if (!$hero) {
            App::abort(404);
        }

        $hero_type = AdminHandler::getAllHeroType($params);

        return view('admin.hero.edit', compact('hero', 'hero_type'));
    }

    /**
     * 编辑英雄资料
     *
     * @param Request $request
     * @param $hero_id
     * @return \Illuminate\Http\JsonResponse
     * @author jiangxianli
     * @created_at 2017-04-24 17:30:34
     */
    public function postEditHero(Request $request, $hero_id)
    {
        $params = $request->all();

        $response = ApiHandler::heroOperate(array_merge($params, ['id' => $hero_id]), 'edit');

        return response()->json($response);
    }
}
