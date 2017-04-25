<?php
namespace GloryKing\Base;

use Carbon\Carbon;
use GloryKing\Model\Image;

/**
 * 图片模型操作基础类
 *
 * Class ImageBase
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017-04-21 17:38:41
 */
class ImageBase extends Base
{
    /**
     * 保存图片
     *
     * @param array $condition
     * @return Image
     * @author jiangxianli
     * @created_at 2017-04-21 17:39:53
     */
    public static function addImage($condition = [])
    {

        $image = new Image();

        $image->fill($condition);
        $image->save();

        return $image;
    }

    /**
     * 保存网络图片
     *
     * @param $src
     * @return Image
     * @author jiangxianli
     * @created_at 2017-04-25 15:54:43
     */
    public static function saveInternetImage($src)
    {
        //文件后缀
        $extension = 'png';
        //访问地址
        $url = '/' . Carbon::now()->format('Y-m-d') . '/' . time() . str_random(8) . '.' . $extension;
        //物理地址
        $path = public_path($url);

        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($path, file_get_contents($src));

        $params = [
            'url'       => $url,
            'path'      => $path,
            'extension' => $extension
        ];

        return self::addImage($params);
    }
}
