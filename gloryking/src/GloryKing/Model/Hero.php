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
        return $this->belongsToMany(__NAMESPACE__ . '\HeroType', HeroTypeRelation::getTableName(), 'hero_id', 'hero_type_id');
    }

    /**
     * HasMany HeroTypeRelation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author jiangxianli
     * @created_at 2017-04-24 16:14:52
     */
    public function heroTypeRelation()
    {
        return $this->hasMany(__NAMESPACE__ . '\HeroTypeRelation', 'hero_id', 'id');
    }

    /**
     * BelongsTo Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2017-04-24 16:15:33
     */
    public function image()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Image', 'image_id', 'id');
    }

    /**
     * 获取图片地址
     *
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-24 16:18:22
     */
    public function getImageSrc()
    {
        $image = $this->image;

        return $image ? $image->url : '';
    }
}
