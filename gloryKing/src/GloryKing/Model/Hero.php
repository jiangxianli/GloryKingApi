<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 英雄模型
 *
 * Class Hero
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:45:19
 */
class Hero extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_hero';
}
