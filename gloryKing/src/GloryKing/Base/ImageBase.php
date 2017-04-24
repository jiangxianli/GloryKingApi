<?php
namespace GloryKing\Base;

use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;
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
}
