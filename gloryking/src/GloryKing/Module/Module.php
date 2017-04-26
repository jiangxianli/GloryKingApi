<?php
namespace GloryKing\Module;

use Library\ErrorMessage\ErrorMessage;
use \DB;

/**
 * 模块基础类
 *
 * Class Module
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017-04-20 15:35:34
 */
class Module
{
    /**
     * 数据库事务处理
     *
     * @param $call_back
     * @param null $connection
     * @param null $success_call_back
     * @return ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-24 15:47:08
     */
    public static function dbTransaction($call_back, $connection = null, $success_call_back = null)
    {
        //获取连接名称
        $conn = $connection ?: config('database.default');

        //初始化数据库连接
        $db = DB::connection($conn);

        //开启事务
        $db->beginTransaction();

        try {
            //调用执行过程
            $response = call_user_func($call_back);

            if (ErrorMessage::isError($response)) {
                return $response;
            }

            //提交事务
            $db->commit();

            //成功回调处理
            if ($success_call_back) {
                call_user_func($success_call_back, $response);
            }

        } catch (\Exception $exception) {
            //回滚事务
            $db->rollback();

            \Log::error($exception->getMessage());
            \Log::error($exception->getTraceAsString());

            return new ErrorMessage('600');
        }
    }
}
