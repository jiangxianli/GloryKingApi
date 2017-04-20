<?php
namespace GloryKing\Base;

use GloryKing\Model\Element;

/**
 * 素材模型操作基础类
 *
 * Class ElementBase
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017-04-20 16:56:20
 */
class ElementBase extends Base
{
    /**
     * 获取热门素材
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:09:17
     */
    public static function getHotElement($condition = [])
    {
        $elements = Element::enable()->orderBy('play_num', 'desc')
            ->orderBy('raise_num', 'desc')
            ->page($condition);

        return $elements;
    }

    /**
     * 根据英雄获取素材
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:13:59
     */
    public static function getElementByHero($condition = [])
    {
        $hero_id = array_get($condition, 'hero_id', 0);

        $elements = Element::where('hero_id', $hero_id)->orderBy('created_at', 'desc')
            ->page($condition);

        return $elements;
    }

}
