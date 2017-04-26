<?php
namespace GloryKing\Base;

use GloryKing\Model\HeroType;
use Library\ErrorMessage\ErrorMessage;
use Library\FormValidator\Admin\AddHeroType;
use Library\FormValidator\FormValidator;

/**
 * 英雄类型模型操作基础类
 *
 * Class HeroTypeBase
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017-04-20 14:45:19
 */
class HeroTypeBase extends Base
{
    /**
     * 添加英雄类型
     *
     * @param array $condition
     * @return HeroType
     * @author jiangxianli
     * @created_at 2017-04-21 15:30:26
     */
    public static function addHeroType($condition = [])
    {
        $name = array_get($condition, 'name', '');

        //检查名称是否存在
        if (HeroType::where('name', $name)->first()) {
            return new ErrorMessage('10000');
        }

        $hero_type = new HeroType();
        $hero_type->fill($condition);
        $hero_type->save();

        return $hero_type;
    }

    /**
     * 获取所有的英雄类型
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-21 17:14:55
     */
    public static function allHeroType($condition = [])
    {
        $hero_type = HeroType::orderBy('sort', 'desc')->get();

        return $hero_type;
    }
}
