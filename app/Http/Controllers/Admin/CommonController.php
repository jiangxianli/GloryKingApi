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
}
