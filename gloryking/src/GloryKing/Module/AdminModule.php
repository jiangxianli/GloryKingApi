<?php
namespace GloryKing\Module;

use GloryKing\Base\AdminBase;
use GloryKing\Base\ImageBase;
use Library\ErrorMessage\ErrorMessage;
use Library\FormValidator\Admin\AdminLogin;
use Library\FormValidator\FormValidator;
use Library\SimpleHtml\CURL;
use Library\SimpleHtml\SimpleHtml;
use Library\UploadFile\UploadFile;

/**
 * 管理员模块
 *
 * Class AdminModule
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017-04-26 17:20:01
 */
class AdminModule extends Module
{
    /**
     * 管理员登录
     *
     * @param array $condition
     * @return ErrorMessage|mixed
     * @author jiangxianli
     * @created_at 2017-04-26 17:27:57
     */
    public static function adminLogin($condition = [])
    {
        //参数校验
        $form_validator = new FormValidator(new AdminLogin(), $condition);
        if ($form_validator->isFailed()) {
            return $form_validator->getError();
        }

        $user_name = array_get($condition, 'user_name', '');
        $password  = array_get($condition, 'password', '');

        $admin = AdminBase::getAdminByUserName($user_name);
        //判断用户是否存在
        if (!$admin) {
            return new ErrorMessage('13000');
        }

        //密码校验
        if (!\Hash::check($password, $admin->password)) {
            return new ErrorMessage('13001');
        }

        return $admin;
    }
}
