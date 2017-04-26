<?php
namespace Library\FormValidator\Admin;

use Library\FormValidator\ValidatorBase;

class AdminLogin extends ValidatorBase
{
    //校验规则
    public static $VALIDATOR_RULES = [
        'user_name' => ['required'],
        'password'  => ['required'],
    ];

    //校验错误信息
    public static $VALIDATOR_MESSAGE = [
        'user_name.required' => '请填写用户名',
        'password.required'  => '请填写密码',
    ];
}
