<?php
namespace GloryKing\Module;

use GloryKing\Base\ElementBase;

/**
 * 素材模块
 *
 * Class ElementModule
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017-04-20 16:55:39
 */
class ElementModule extends Module
{
    /**
     * 获取素材
     *
     * @param array $condition
     * @return array|mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:14:59
     */
    public static function getElements($condition = [])
    {
        $by = array_get($condition, 'by', '');
        switch ($by) {
            case 'hot':
                //根据热度获取素材
                return ElementBase::getHotElement($condition);
                break;
            case 'hero':
                //根据英雄获取素材
                return ElementBase::getElementByHero($condition);
                break;
            default:
                return [];
                break;
        }
    }
}
