<?php
namespace Library\FormValidator\Admin;

use Library\FormValidator\ValidatorBase;

class EditTheme extends ValidatorBase
{
    //校验规则
    public static $VALIDATOR_RULES = [
        'id'       => ['required', 'integer', 'min:0'],
        'name'     => ['required'],
        'disabled' => ['in:0,1'],
        'sort'     => ['required', 'integer', 'min:0'],
        'image_id' => ['required', 'integer', 'min:0'],
    ];

    //校验错误信息
    public static $VALIDATOR_MESSAGE = [
        'id.required'       => '参数错误',
        'id.integer'        => '参数错误',
        'id.min'            => '参数错误',
        'name.required'     => '请填写标题',
        'disabled.in'       => '请选择是否启用',
        'sort.required'     => '请设置正确的排序值',
        'sort.integer'      => '请设置正确的排序值',
        'sort.min'          => '请设置正确的排序值',
        'image_id.required' => '请上传图片',
        'image_id.integer'  => '请上传图片',
        'image_id.min'      => '请上传图片'
    ];
}
