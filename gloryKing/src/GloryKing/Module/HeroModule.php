<?php
namespace GloryKing\Module;

use GloryKing\Base\HeroBase;

/**
 * 英雄模块
 *
 * Class HeroModule
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017-04-20 15:36:56
 */
class HeroModule extends Module
{
    /**
     * 获取英雄列表
     *
     * @param array $condition
     * @return array|mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:46:17
     */
    public static function getHeroList($condition = [])
    {
        $by = array_get($condition, 'by', '');
        switch ($by) {
            case 'type_id':
                //根据类型ID获取英雄
                return HeroBase::getHeroByType($condition);
                break;
            case 'type_hero':
                //获取类型及类型下的英雄
                return HeroBase::getTypeHeroList($condition);
                break;
            default:
                return [];

        }
    }
}

