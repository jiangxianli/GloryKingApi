<?php
namespace GloryKing\Base;

/**
 * 模型基础类
 *
 * Class Base
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017-04-20 14:48:49
 */
class Base
{
    /**
     * 分页处理
     *
     * @param $builder
     * @param array $condition
     * @param int $per_page
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 17:08:24
     */
    public static function page($builder, $condition = [], $per_page = 10)
    {
        $per_page = array_get($condition, 'per_page', $per_page);

        return $builder->paginate($per_page);
    }
}
