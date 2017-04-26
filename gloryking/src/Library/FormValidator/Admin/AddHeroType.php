<?php
namespace Library\FormValidator\Admin;

use Library\FormValidator\ValidatorBase;

class AddHeroType extends ValidatorBase
{
    //校验规则
    public static $VALIDATOR_RULES = [
        'name'     => ['required'],
        'disabled' => ['in:0,1'],
        'sort'     => ['required', 'integer', 'min:0']
    ];

    //校验错误信息
    public static $VALIDATOR_MESSAGE = [
        'name.required' => '请填写类型名称',
        'disabled.in'   => '请选择是否启用',
        'sort.required' => '请设置正确的排序值',
        'sort.integer'  => '请设置正确的排序值',
        'sort.min'      => '请设置正确的排序值'
    ];
}
