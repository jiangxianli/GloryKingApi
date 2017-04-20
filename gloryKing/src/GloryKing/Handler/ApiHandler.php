<?php
namespace GloryKing\Handler;

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
        $response = HeroModule::getHeroList($condition);

        return self::apiResponse($response);
    }
}
