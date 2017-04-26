<?php
namespace GloryKing\Base;

use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;
use Library\ErrorMessage\ErrorMessage;

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
        $hero = Hero::with([
            'image' => function ($query) {
                $query->select(['*']);
            }
        ])->whereHas('heroTypeRelation', function ($query) use ($type_id) {
            if ($type_id) {
                $query->where('hero_type_id', $type_id);
            }
        });

        //分页处理
        $hero = self::page($hero, $condition);

        return $hero;
    }

    /**
     * 获取所有的英雄
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-24 18:21:19
     */
    public static function getAllHero($condition = [])
    {
        $hero = Hero::enable()->get();

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
                    'wz_hero.id', 'name', 'image_id'
                ]);
            }
        ])->enable()->orderBy('sort', 'desc')->get();

        return $hero;
    }

    /**
     * 添加英雄
     *
     * @param array $condition
     * @return Hero|ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-24 15:11:42
     */
    public static function addHero($condition = [])
    {
        $name = array_get($condition, 'name', '');
        if (Hero::where('name', $name)->first()) {
            return new ErrorMessage('11000');
        }
        $hero = new Hero();
        $hero->fill($condition);
        $hero->save();

        $type_id = array_get($condition, 'type_id', []);
        $hero->heroType()->sync($type_id);

        return $hero;
    }

    /**
     * 编辑英雄
     *
     * @param array $condition
     * @return ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-24 17:29:25
     */
    public static function editHero($condition = [])
    {
        $id   = array_get($condition, 'id', 0);
        $name = array_get($condition, 'name', '');

        //查找原记录
        $hero = Hero::find($id);
        if (!$hero) {
            return new ErrorMessage('11001');
        }

        //检查相同名称是否存在
        $check_exist = Hero::where('name', $name)->where('id', '!=', $id)->first();
        if ($check_exist) {
            return new ErrorMessage('11000');
        }

        $hero->fill($condition);
        $hero->save();

        $type_id = array_get($condition, 'type_id', []);
        $hero->heroType()->sync($type_id);

        return $hero;
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
        $hero = Hero::with([
            'heroTypeRelation' => function ($query) {
                $query->select(['*']);
            },
            'image'            => function ($query) {
                $query->select(['*']);
            }
        ])->where('id', $hero_id)->first();

        return $hero;
    }
}
