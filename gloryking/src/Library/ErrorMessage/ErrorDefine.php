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
        '2003'  => '参数错误',

        //英雄类型
        '10000' => '相同名称的类型已存在',

        //英雄
        '11000' => '相同名称的英雄已存在',
        '11001' => '对应ID的英雄不存在',

        //视频
        '12000' => '相同名称的视频已经存在',
        '12001' => '无法解析的视频地址',
        '12002' => '解析失败，无法获取到播放地址',
        '12003' => '该视频不存在，无法操作',

        //管理员
        '13000' => '用户名不存在',
        '13001' => '密码错误',

        //主题
        '14000' => '相同名称的主题已经存在',
        '14001' => '对应ID的主题不存在',

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
