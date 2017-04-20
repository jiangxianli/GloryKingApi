<?php
namespace GloryKing\Base;

use GloryKing\Model\Hero;

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
     * 构造函数
     */
    public function __construct()
    {
        //设置模型
        $this->setModel(new Hero());
    }

    /**
     * 添加一个英雄
     *
     * @param $params
     * @return 模型对象
     * @author jiangxianli
     * @created_at 2017-04-20 15:40:09
     */
    public function addHero($params)
    {
        $hero = $this->getModel();

        $hero->fill($params);
        $hero->save();

        return $hero;
    }

    /**
     * 删除一个英雄
     *
     * @param $hero_id
     * @author jiangxianli
     * @created_at 2017-04-20 15:41:52
     */
    public function deleteHero($hero_id)
    {
        $hero = $this->getModel();

        $hero->whereId($hero_id)->delete();
    }
}
