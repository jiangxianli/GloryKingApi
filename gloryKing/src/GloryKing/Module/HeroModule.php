<?php
namespace GloryKing\Module;

use GloryKing\Base\HeroBase;
use GloryKing\Base\HeroTypeBase;
use Library\FormValidator\Admin\AddHero;
use Library\FormValidator\Admin\AddHeroType;
use Library\FormValidator\Admin\EditHero;
use Library\FormValidator\FormValidator;

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
            case 'all_hero':
                return HeroBase::getAllHero($condition);
                break;
            default:
                return [];

        }
    }

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
        return HeroTypeBase::allHeroType($condition);
    }

    /**
     * 英雄类型操作
     *
     * @param array $condition
     * @param string $operate
     * @return \GloryKing\Model\HeroType|\Library\ErrorMessage\ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-21 15:58:31
     */
    public static function heroTypeOperate($condition = [], $operate = '')
    {
        switch ($operate) {
            case 'add':
                $form_validator = new FormValidator(new AddHeroType(), $condition);
                if ($form_validator->isFailed()) {
                    return $form_validator->getError();
                }

                return HeroTypeBase::addHeroType($condition);
                break;
        }
    }

    /**
     * 英雄操作
     *
     * @param array $condition
     * @param string $operate
     * @return \GloryKing\Model\Hero|\Library\ErrorMessage\ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-24 15:18:40
     */
    public static function heroOperate($condition = [], $operate = '')
    {
        switch ($operate) {
            case 'add':
                $form_validator = new FormValidator(new AddHero(), $condition);
                if ($form_validator->isFailed()) {
                    return $form_validator->getError();
                }

                return self::dbTransaction(function () use ($condition) {
                    HeroBase::addHero($condition);
                });
                break;
            case 'edit':
                $form_validator = new FormValidator(new EditHero(), $condition);
                if ($form_validator->isFailed()) {
                    return $form_validator->getError();
                }

                return self::dbTransaction(function () use ($condition) {
                    HeroBase::editHero($condition);
                });
                break;
        }
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
        return HeroBase::getHeroDetail($hero_id);
    }

}

