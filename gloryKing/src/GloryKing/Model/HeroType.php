<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 英雄类型模型
 *
 * Class HeroType
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:45:34
 */
class HeroType extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_hero_type';
}
