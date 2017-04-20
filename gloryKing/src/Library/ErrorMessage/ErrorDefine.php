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
        '1000' => '未定义错误码,请检查!',


        '10000' => ''

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
