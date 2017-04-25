<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GloryKing\Handler\AdminHandler;
use GloryKing\Handler\ApiHandler;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * 上传图片
     *
     * @param Request $request
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-21 17:47:14
     */
    public function postUploadImage(Request $request)
    {
        return ApiHandler::uploadImage($request->file('file'));
    }

    /**
     * 解析视频地址
     *
     * @param Request $request
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-25 15:57:18
     */
    public function postParseVideoUrl(Request $request)
    {
        $from_url = $request->get('from_url');

        return ApiHandler::parseVideoUrl($from_url);
    }
}
