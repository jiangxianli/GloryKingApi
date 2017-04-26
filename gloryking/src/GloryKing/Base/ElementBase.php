<?php
namespace GloryKing\Base;

use GloryKing\Model\Element;
use Library\ErrorMessage\ErrorMessage;
use Library\Helper;

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
            ->orderBy('raise_num', 'desc');

        $elements = self::page($elements, $condition);

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

        $elements = Element::where('hero_id', $hero_id)->orderBy('created_at', 'desc');
        $elements = self::page($elements, $condition);

        return $elements;
    }

    /**
     * 根据英雄类型获取素材
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:13:59
     */
    public static function getElementByTypeId($condition = [])
    {
        $type_id = array_get($condition, 'type_id', 0);

        $elements = Element::whereHas('hero.heroTypeRelation', function ($query) use ($type_id) {
            $query->where('hero_type_id', $type_id);
        })->orderBy('created_at', 'desc');
        $elements = self::page($elements, $condition);

        return $elements;
    }

    /**
     * 获取所有的元素
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-24 19:07:57
     */
    public static function getAllElement($condition = [])
    {
        $elements = Element::orderBy('created_at', 'desc');

        $elements = self::page($elements, $condition);

        return $elements;
    }

    /**
     * 添加素材
     *
     * @param array $condition
     * @return Hero|ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-24 15:11:42
     */
    public static function addElement($condition = [])
    {
        $title = array_get($condition, 'title', '');
        $url   = array_get($condition, 'url', '');
        //检查同名视频是否存在
        if (Element::where('title', $title)->orWhere('url', $url)->first()) {
            return new ErrorMessage('12000');
        }

        $element = new Element();
        $element->fill($condition);
        $element->unique_id = Helper::uuid('v');
        $element->save();

        return $element;
    }

    /**
     * 更新素材
     *
     * @param array $condition
     * @return ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-26 10:44:00
     */
    public static function editElement($condition = [])
    {
        $id = array_get($condition, 'id', 0);

        $element = Element::find($id);
        if (!$element) {
            return new ErrorMessage('12003');
        }

        $element->fill($condition);
        $element->save();

        return $element;
    }

    /**
     * 统计项自增
     *
     * @param $unique_id
     * @param $column
     * @author jiangxianli
     * @created_at 2017-04-26 16:01:57
     */
    public static function incrementByColumn($unique_id, $column)
    {
        Element::where('unique_id', $unique_id)->increment($column);
    }

    /**
     * 根据ID获取素材详情
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-26 10:18:25
     */
    public static function getElementDetail($condition = [])
    {
        $id        = array_get($condition, 'id', 0);
        $unique_id = array_get($condition, 'unique_id', 0);

        if (!$id && !$unique_id) {
            return new ErrorMessage('2003');
        }

        $element = Element::with([
            'image' => function ($query) {
                $query->select(['*']);
            }
        ])->where(function ($query) use ($id, $unique_id) {
            if ($id) {
                $query->where('id', $id);
            }

            if ($unique_id) {
                $query->where('unique_id', $unique_id);
            }
        })->first();

        return $element;
    }


}
