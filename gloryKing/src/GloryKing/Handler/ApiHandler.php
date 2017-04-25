<?php
namespace GloryKing\Handler;

use GloryKing\Module\CommonModule;
use GloryKing\Module\ElementModule;
use GloryKing\Module\HeroModule;

/**
 * Api接口处理器
 *
 * Class ApiHandler
 * @package GloryKing\Handler
 * @author jiangxianli
 * @created_at 2017-04-20 15:36:10
 */
class ApiHandler extends Handler
{
    /**
     * 获取元素列表
     *
     * @param array $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-20 17:56:46
     */
    public static function getElementList($condition = [])
    {
        $response = ElementModule::getElements($condition);

        return self::apiResponse($response);
    }

    /**
     * 获取英雄列表
     *
     * @param array $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-20 18:03:21
     */
    public static function getHeroList($condition = [])
    {
        $collection = HeroModule::getHeroList($condition);

        $items = [];
        foreach ($collection as $item) {
            $items[] = [
                'hero_id'   => $item->id,
                'hero_name' => $item->name,
                'image_url' => $item->getImageSrc(),
            ];
        }
        $response = self::pageData2Array($items, $collection);

        return self::apiResponse($response);
    }

    /**
     * 英雄类型操作
     *
     * @param array $condition
     * @param string $operate
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-21 16:01:27
     */
    public static function heroTypeOperate($condition = [], $operate = '')
    {
        $response = HeroModule::heroTypeOperate($condition, $operate);

        return self::apiResponse($response);
    }

    /**
     * 上传图片
     *
     * @param $file
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-21 17:44:35
     */
    public static function uploadImage($file)
    {
        $response = CommonModule::uploadImage($file);

        return self::apiResponse($response);
    }

    /**
     * 英雄操作
     *
     * @param array $condition
     * @param string $operate
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-24 14:59:41
     */
    public static function heroOperate($condition = [], $operate = '')
    {
        $response = HeroModule::heroOperate($condition, $operate);

        return self::apiResponse($response);
    }

    public static function parseVideoUrl($from_url)
    {

    }
}
