<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 专题模型
 *
 * Class Theme
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017年04月28日11:12:03
 */
class Theme extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_theme';

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image_id',
        'sort',
        'disabled',
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
     * BelongsToMany Element
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author jiangxianli
     * @created_at 2017-04-28 11:51:14
     */
    public function element()
    {
        return $this->belongsToMany(__NAMESPACE__ . '\Element', ThemeElement::getTableName(), 'theme_id', 'element_id');
    }
}
