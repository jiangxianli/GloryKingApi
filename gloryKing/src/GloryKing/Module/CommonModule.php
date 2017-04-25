<?php
namespace GloryKing\Module;

use GloryKing\Base\HeroBase;
use GloryKing\Base\HeroTypeBase;
use GloryKing\Base\ImageBase;
use Library\ErrorMessage\ErrorMessage;
use Library\FormValidator\Admin\AddHeroType;
use Library\FormValidator\FormValidator;
use Library\UploadFile\UploadFile;

/**
 * 通用模块
 *
 * Class CommonModule
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017-04-21 17:37:24
 */
class CommonModule extends Module
{
    /**
     * 上传图片
     *
     * @param $file
     * @return \GloryKing\Model\Image|ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-21 17:44:35
     */
    public static function uploadImage($file)
    {
        //初始化上传器
        $upload = new UploadFile(['jpg', 'png'], 20 * 1024);
        //上传文件
        $file = $upload->upload($file, 'hero');

        //错误校验
        if (ErrorMessage::isError($file)) {
            return $file;
        }

        //保存图片
        $params = [
            'url'       => $upload->getFileUrl(),
            'path'      => $upload->getFilePath(),
            'extension' => $upload->getFileExtension()
        ];
        return ImageBase::addImage($params);
    }

    public static function parseVideoUrl($from_url)
    {
        if (starts_with($from_url, 'https://m.v.qq.com')) {

        }
        //https://m.v.qq.com/x/cover/9/9ud9svo40zvaxlb.html?vid=v0396t870fu
    }
}
