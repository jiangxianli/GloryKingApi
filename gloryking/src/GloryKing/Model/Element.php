<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 素材模型
 *
 * Class Element
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:47:45
 */
class Element extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_element';

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'from_url',
        'title',
        'url',
        'hero_id',
        'image_id',
        'sort',
        'disabled',
        'duration'
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
     * BelongsTo Hero
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2017-04-24 19:16:10
     */
    public function hero()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Hero', 'hero_id', 'id');
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
}
