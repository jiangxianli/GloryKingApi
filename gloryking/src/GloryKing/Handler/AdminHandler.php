<?php
namespace GloryKing\Handler;

use GloryKing\Module\AdminModule;
use GloryKing\Module\ElementModule;
use GloryKing\Module\HeroModule;
use GloryKing\Module\ThemeModule;
use Library\ErrorMessage\ErrorMessage;

/**
 * 管理后台处理器
 *
 * Class AdminHandler
 * @package GloryKing\Handler
 * @author jiangxianli
 * @created_at 2017-04-21 17:16:51
 */
class AdminHandler extends Handler
{
    /**
     * 获取所有的英雄类型
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-21 17:14:55
     */
    public static function getAllHeroType($condition = [])
    {
        return HeroModule::getAllHeroType($condition);
    }

    /**
     * 添加英雄
     *
     * @param array $condition
     * @return \GloryKing\Model\HeroType|\Library\ErrorMessage\ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-24 15:59:26
     */
    public static function addHero($condition = [])
    {
        return HeroModule::heroTypeOperate($condition, 'add');
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
        return HeroModule::getHeroList($condition);
    }

    /**
     * 获取英雄详细信息
     *
     * @param $hero_id
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-24 16:40:49
     */
    public static function getHeroDetail($hero_id)
    {
        return HeroModule::getHeroDetail($hero_id);
    }

    /**
     * 素材操作
     *
     * @param $condition
     * @param $operate
     * @return \Library\ErrorMessage\ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-24 18:34:11
     */
    public static function elementOperate($condition, $operate)
    {
        $response = ElementModule::elementOperate($condition, $operate);

        return self::apiResponse($response);
    }

    /**
     * 获取元素列表
     *
     * @param $condition
     * @return array|mixed
     * @author jiangxianli
     * @created_at 2017-04-24 19:09:46
     */
    public static function getElements($condition)
    {
        return ElementModule::getElements($condition);
    }

    /**
     * 搜索元素列表
     *
     * @param $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-28 13:38:43
     */
    public static function searchElement($condition)
    {
        $response = ElementModule::getElements($condition);

        return self::apiResponse($response);
    }

    /**
     * 管理员登录
     *
     * @param $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-26 17:29:39
     */
    public static function adminLogin($condition)
    {
        $response = AdminModule::adminLogin($condition);

        if (!ErrorMessage::isError($response)) {
            \Auth::login($response);
        }

        return self::apiResponse($response);
    }

    /**
     * 专题操作
     *
     * @param $condition
     * @param $operate
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-28 11:41:26
     */
    public static function themeOperate($condition, $operate)
    {
        $response = ThemeModule::themeOperate($condition, $operate);

        return self::apiResponse($response);
    }

    /**
     * 获取专题列表
     *
     * @param $condition
     * @return ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-28 11:58:30
     */
    public static function getThemeList($condition)
    {
        return ThemeModule::getThemeList($condition);
    }
}
