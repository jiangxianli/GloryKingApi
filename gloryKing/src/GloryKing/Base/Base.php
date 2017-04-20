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
     * @var 模型对象
     */
    private $model;

    /**
     * 设置模型对象
     *
     * @param $model
     * @author jiangxianli
     * @created_at 2017-04-20 15:27:01
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * 获取模型对象
     *
     * @return 模型对象
     * @author jiangxianli
     * @created_at 2017-04-20 15:27:29
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * 获取一条数据
     *
     * @param array $condition
     * @param array $select
     * @param array $relation
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 15:28:30
     */
    public function getOneRow($condition = [], $select = ['*'], $relation = [])
    {
        $model = $this->getModel();

        return $model->select($select)->where($condition)->with($relation)->first();
    }

    /**
     * 获取所有的数据
     *
     * @param array $condition
     * @param array $select
     * @param array $relation
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 15:29:11
     */
    public function getAllRow($condition = [], $select = ['*'], $relation = [])
    {
        $model = $this->getModel();

        return $model->select($select)->where($condition)->with($relation)->get();
    }

    /**
     * 获取分页数据
     *
     * @param array $condition
     * @param array $select
     * @param array $relation
     * @param int $paginate
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 15:30:18
     */
    public function getPageRow($condition = [], $select = ['*'], $relation = [], $paginate = 10)
    {
        $model = $this->getModel();

        return $model->select($select)->where($condition)->with($relation)->paginate($paginate);
    }
}
