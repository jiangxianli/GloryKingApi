<?php
namespace GloryKing\Handler;

use GloryKing\Module\ElementModule;
use GloryKing\Module\HeroModule;

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
}
