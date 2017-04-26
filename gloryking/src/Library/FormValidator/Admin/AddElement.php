<?php
namespace Library\FormValidator\Admin;

use Library\FormValidator\ValidatorBase;

class AddElement extends ValidatorBase
{
    //校验规则
    public static $VALIDATOR_RULES = [
        'title'    => ['required'],
        'url'      => ['required'],
        'disabled' => ['in:0,1'],
        'sort'     => ['required', 'integer', 'min:0'],
        'hero_id'  => ['required', 'integer'],
        'image_id' => ['required', 'integer', 'min:0'],
    ];

    //校验错误信息
    public static $VALIDATOR_MESSAGE = [
        'title.required'    => '请填写标题',
        'url.required'      => '请填写播放地址',
        'disabled.in'       => '请选择是否启用',
        'sort.required'     => '请设置正确的排序值',
        'sort.integer'      => '请设置正确的排序值',
        'sort.min'          => '请设置正确的排序值',
        'hero_id.required'  => '请选择关联的英雄',
        'hero_id.integer'   => '请选择关联的英雄',
        'image_id.required' => '请上传图片',
        'image_id.integer'  => '请上传图片',
        'image_id.min'      => '请上传图片'
    ];
}
