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
}
