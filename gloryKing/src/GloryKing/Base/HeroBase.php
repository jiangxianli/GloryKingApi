<?php
namespace GloryKing\Base;

use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;

/**
 * 英雄模型操作基础类
 *
 * Class HeroBase
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017-04-20 14:45:19
 */
class HeroBase extends Base
{
    /**
     * 根据类型获取英雄
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:33:12
     */
    public static function getHeroByType($condition = [])
    {
        //类型ID
        $type_id = array_get($condition, 'type_id', 0);

        //获取英雄
        $hero = Hero::whereHas('heroType', function ($query) use ($type_id) {
            $query->where('hero_type_id', $type_id);
        })->get();

        return $hero;
    }

    /**
     * 获取类型及类型下的英雄
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:43:13
     */
    public static function getTypeHeroList($condition = [])
    {
        $hero = HeroType::with([
            'hero' => function ($query) {
                $query->select([
                    'id', 'name', 'image_id'
                ]);
            }
        ])->enable()->orderBy('sort', 'desc')->get();

        return $hero;
    }
}
