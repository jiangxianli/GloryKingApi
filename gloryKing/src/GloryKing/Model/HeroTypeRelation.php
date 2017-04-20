<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 英雄类型关联模型
 *
 * Class HeroTypeRelation
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:46:20
 */
class HeroTypeRelation extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_hero_type_relation';
}
