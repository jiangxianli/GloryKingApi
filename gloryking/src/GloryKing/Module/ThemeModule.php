<?php
namespace GloryKing\Module;

use GloryKing\Base\ElementBase;
use GloryKing\Base\ThemeBase;
use Library\ErrorMessage\ErrorMessage;
use Library\FormValidator\Admin\AddElement;
use Library\FormValidator\Admin\AddTheme;
use Library\FormValidator\Admin\EditElement;
use Library\FormValidator\Admin\EditTheme;
use Library\FormValidator\FormValidator;

/**
 * 专题模块
 *
 * Class ThemeModule
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017年04月28日11:15:46
 */
class ThemeModule extends Module
{
    /**
     * 获取专题列表
     *
     * @param $condition
     * @return ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-28 11:57:53
     */
    public static function getThemeList($condition)
    {
        $by = array_get($condition, 'by', '');
        switch ($by) {
            case 'all':
                //根据热度获取素材
                return ThemeBase::getAllTheme($condition);
                break;
            case 'id':
                return ThemeBase::getThemeById($condition);
                break;
            case 'enabled':
                //根据英雄获取素材
                return ThemeBase::getAllEnableTheme($condition);
                break;
            default:
                return new ErrorMessage('2003');
                break;
        }
    }

    /**
     * 专题操作
     *
     * @param $condition
     * @param string $operate
     * @return ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-28 11:42:09
     */
    public static function themeOperate($condition, $operate = '')
    {
        switch ($operate) {
            case 'add':
                $form_validator = new FormValidator(new AddTheme(), $condition);
                if ($form_validator->isFailed()) {
                    return $form_validator->getError();
                }

                return self::dbTransaction(function () use ($condition) {
                    ThemeBase::addTheme($condition);
                });
                break;
            case 'edit':
                $form_validator = new FormValidator(new EditTheme(), $condition);
                if ($form_validator->isFailed()) {
                    return $form_validator->getError();
                }

                return self::dbTransaction(function () use ($condition) {
                    ThemeBase::editTheme($condition);
                });
                break;
        }
    }
}
