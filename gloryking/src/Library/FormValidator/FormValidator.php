<?php
namespace Library\FormValidator;

use Library\ErrorMessage\ErrorMessage;
use \Validator;

/**
 * 表单校验
 *
 * Class FormValidator
 * @package Library\FormValidator
 * @author jiangxianli
 * @created_at 2017-04-21 15:54:02
 */
class FormValidator
{
    /**
     * 是否校验失败
     *
     * @var bool
     */
    private $failed = false;

    /**
     * 校验错误信息
     *
     * @var array
     */
    private $errors = [];

    public function __construct(ValidatorBase $validatorBase, array $validator_data)
    {
        $validator = Validator::make(
            $validator_data,
            $validatorBase::$VALIDATOR_RULES,
            $validatorBase::$VALIDATOR_MESSAGE
        );
        \Log::info($validator->fails());
        if ($validator->fails()) {
            $this->failed = true;
            $this->errors = $validator->errors()->all();

            \Log::info($this->errors);
        }
    }

    /**
     * 是否验证失败
     * @return bool
     * @author jiangxianli
     * @created_at 2017-04-21 15:48:49
     */
    public function isFailed()
    {
        return $this->failed;
    }

    /**
     * 获取错误信息
     *
     * @param bool $single_error
     * @return ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-21 15:53:45
     */
    public function getError($single_error = true)
    {
        $error = $single_error && $this->errors ? array_first($this->errors) : $this->errors;

        return new ErrorMessage('1001', [], $error);
    }
}
