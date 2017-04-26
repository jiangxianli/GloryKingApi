<?php
namespace Library\ErrorMessage;

/**
 * 错误消息处理类
 *
 * Class ErrorMessage
 * @package Library\ErrorMessage
 * @author jiangxianli
 * @created_at 2017-04-20 15:48:40
 */
class ErrorMessage
{
    /**
     * @var 错误码
     */
    private $code;
    /**
     * @var 返回数据
     */
    private $data;

    /**
     * @var 错误消息
     */
    private $msg;

    /**
     * 设置错误码
     *
     * @param $code
     * @author jiangxianli
     * @created_at 2017-04-20 15:49:27
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * 获取错误码
     *
     * @return 错误码
     * @author jiangxianli
     * @created_at 2017-04-20 15:49:39
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 设置返回数据
     *
     * @param $data
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-20 15:49:55
     */
    public function setData($data)
    {
        return $this->data = $data;
    }

    /**
     * 获取返回数据
     *
     * @return 返回数据
     * @author jiangxianli
     * @created_at 2017-04-20 15:50:15
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 设置错误消息
     *
     * @param $msg
     * @author jiangxianli
     * @created_at 2017-04-20 15:50:30
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * 获取错误消息
     *
     * @return 错误消息
     * @author jiangxianli
     * @created_at 2017-04-20 15:50:48
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * 错误消息构造函数
     *
     * @param $code
     * @param array $data
     * @param $msg
     * @author jiangxianli
     * @created_at 2017-04-20 15:50:30
     */
    public function __construct($code = 0, $data = [], $msg = '')
    {
        $this->code = $code;
        $this->msg  = $msg;
        $this->data = $data;
    }

    /**
     * 判断是否是错误消息
     *
     * @param $error_message
     * @return bool
     * @author jiangxianli
     * @created_at 2017-04-20 15:54:52
     */
    public static function isError($error_message)
    {
        return $error_message instanceof ErrorMessage;
    }

    /**
     * 格式化输出错误信息
     *
     * @param array $format
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-20 16:00:45
     */
    public function formatError($format = ['code', 'data', 'msg'])
    {
        $code_key = array_get($format, 0, 'code');
        $data_key = array_get($format, 1, 'data');
        $msg_key  = array_get($format, 2, 'msg');

        //处理错误消息内容
        $this->handlerErrorCode();

        //返回自定义格式错误消息
        return [
            $code_key => $this->getCode(),
            $data_key => $this->getData(),
            $msg_key  => $this->getMsg()
        ];
    }

    /**
     * 处理错误消息
     *
     * @author jiangxianli
     * @created_at 2017-04-20 16:12:26
     */
    private function handlerErrorCode()
    {
        //处理错误码
        $error_code = ErrorDefine::checkErrorCode($this->getCode());
        $this->setCode($error_code);

        //处理错误消息
        $error_msg = $this->getMsg();
        $this->setMsg($error_msg ?: ErrorDefine::getErrorMsg($error_code));
    }
}
