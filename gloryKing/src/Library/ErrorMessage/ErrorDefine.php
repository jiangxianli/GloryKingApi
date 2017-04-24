<?php
namespace Library\ErrorMessage;

/**
 * 错误消息定义
 *
 * Class ErrorDefine
 * @package Library\ErrorMessage
 * @author jiangxianli
 * @created_at 2017-04-20 16:02:21
 */
class ErrorDefine
{
    /**
     * 错误码定义
     *
     * @var array
     */
    public static $error_map = [

        '500'  => '服务器错误!',
        '600'  => '系统错误!',
        '1000' => '未定义错误码,请检查!',
        '1001' => '参数校验失败',

        '2000'  => '不合法的文件,请重新上传!',
        '2001'  => '不允许的后缀文件!',
        '2002'  => '文件超过限制大小!',

        //英雄类型
        '10000' => '相同名称的类型已存在',

        //英雄
        '11000' => '相同名称的英雄已存在'

    ];

    /**
     * 检查错误码
     *
     * @param $code
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 16:08:42
     */
    public static function checkErrorCode($code)
    {
        if (array_key_exists($code, static::$error_map)) {
            return $code;
        }

        return '1000';
    }

    /**
     * 获取错误码对应的消息
     *
     * @param $code
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 16:11:31
     */
    public static function getErrorMsg($code)
    {
        if (array_key_exists($code, static::$error_map)) {
            return static::$error_map[$code];
        }

        return static::$error_map['1000'];
    }
}
