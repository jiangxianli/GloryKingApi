<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * 基础模型
 *
 * Class Base
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:40:39
 */
class Base extends Model
{
    /**
     * 获取表名
     *
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:36:31
     */
    public static function getTableName()
    {
        return (new static())->getTable();
    }
}
