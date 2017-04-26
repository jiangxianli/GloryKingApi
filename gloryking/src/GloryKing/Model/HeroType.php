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

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sort',
        'disabled'
    ];

    /**
     * 查询显示的
     *
     * @param $query
     * @author jiangxianli
     * @created_at 2017-04-20 17:04:01
     */
    public function scopeEnable($query)
    {
        $query->where('disabled', 0);
    }

    /**
     * HasManyThrough Hero
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     * @author jiangxianli
     * @created_at 2017-04-20 17:39:02
     */
    public function hero()
    {
        return $this->belongsToMany(__NAMESPACE__ . '\Hero', HeroTypeRelation::getTableName(), 'hero_type_id', 'hero_id');
    }
}
