<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 专题元素模型
 *
 * Class ThemeElement
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-28 11:13:15
 */
class ThemeElement extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_theme_element';

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'theme_id',
        'element_id',
    ];

    /**
     * BelongsTo Element
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2017年04月28日11:14:53
     */
    public function element()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Element', 'element_id', 'id');
    }

    /**
     * BelongsTo Theme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author jiangxianli
     * @created_at 2017年04月28日11:15:11
     */
    public function theme()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Theme', 'theme_id', 'id');
    }
}
