<?php
namespace GloryKing\Base;

use GloryKing\Model\Element;
use GloryKing\Model\Theme;
use Library\ErrorMessage\ErrorMessage;
use Library\Helper;

/**
 * 专题模型操作基础类
 *
 * Class ThemeBase
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017年04月28日11:17:05
 */
class ThemeBase extends Base
{
    /**
     * 添加专题
     *
     * @param array $condition
     * @return ErrorMessage
     * @author jiangxianli
     * @created_at 2017年04月28日11:21:39
     */
    public static function addTheme($condition = [])
    {
        $name = array_get($condition, 'name', '');

        //名称检查是否存在
        $check = Theme::where('name', $name)->first();
        if ($check) {
            return new ErrorMessage('14000');
        }

        $theme = new Theme();
        $theme->fill($condition);
        $theme->save();

        //关联素材
        $element_id = array_get($condition, 'element_id', []);
        $theme->element()->sync($element_id);
    }

    /**
     * 更新专题
     *
     * @param array $condition
     * @return ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-28 11:24:21
     */
    public static function editTheme($condition = [])
    {
        $name = array_get($condition, 'name', '');
        $id   = array_get($condition, 'id', 0);

        //名称检查是否存在
        $check = Theme::where('name', $name)->where('id', '!=', $id)->first();
        if ($check) {
            return new ErrorMessage('14000');
        }

        $theme = Theme::find($id);
        if (!$theme) {
            return new ErrorMessage('14001');
        }
        $theme->fill($condition);
        $theme->save();

        //关联素材
        $element_id = array_get($condition, 'element_id', []);
        $theme->element()->sync($element_id);
    }

    /**
     * 获取所有专题，并分页
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-28 11:55:33
     */
    public static function getAllTheme($condition = [])
    {
        $theme = Theme::orderBy('id', 'desc');

        $theme = self::page($theme, $condition);

        return $theme;
    }

    /**
     * 获取所有可用专题
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-28 11:56:32
     */
    public static function getAllEnableTheme($condition = [])
    {
        $theme = Theme::enable()->get();

        return $theme;
    }

    /**
     * 根据ID获取专题
     *
     * @param array $condition
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-05-02 11:04:28
     */
    public static function getThemeById($condition = [])
    {
        $id = array_get($condition, 'id', 0);

        $theme = Theme::with([
            'image'   => function ($query) {
                $query->select(['*']);
            },
            'element' => function ($query) {
                $query->select(['*']);
            }])->where('id', $id)->first();

        return $theme;
    }
}
