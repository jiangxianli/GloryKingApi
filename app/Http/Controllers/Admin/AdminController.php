<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GloryKing\Handler\AdminHandler;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * 上传图片
     *
     * @param Request $request
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-21 17:47:14
     */
    public function getLogin(Request $request)
    {
        return view('admin.login');
    }

    /**
     * 解析视频地址
     *
     * @param Request $request
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-25 15:57:18
     */
    public function postLogin(Request $request)
    {
        $params = $request->all();

        $response = AdminHandler::adminLogin($params);

        return response()->json($response);
    }

    /**
     * 退出系统
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @author jiangxianli
     * @created_at 2017-04-26 18:04:44
     */
    public function getLogout(Request $request)
    {
        if (\Auth::user()) {
            \Auth::logout();
        }

        return redirect()->action('Admin\AdminController@getLogin');
    }
}
