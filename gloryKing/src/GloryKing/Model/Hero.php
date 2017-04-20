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

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image_id',
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
     * HasMany HeroType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author jiangxianli
     * @created_at 2017-04-20 17:25:59
     */
    public function heroType()
    {
        return $this->hasMany(__NAMESPACE__ . '\HeroType', 'hero_id', 'id');
    }
}
