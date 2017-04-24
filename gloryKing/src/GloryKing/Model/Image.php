<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 图片模型
 *
 * Class Image
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:47:00
 */
class Image extends Base
{
    use SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_image';

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'path',
        'extension',
    ];
}
