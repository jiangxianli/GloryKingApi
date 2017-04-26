<?php
namespace GloryKing\Base;

use GloryKing\Model\Admin;
use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;
use Library\ErrorMessage\ErrorMessage;

/**
 * 管理员模型操作基础类
 *
 * Class AdminBase
 * @package GloryKing\Base
 * @author jiangxianli
 * @created_at 2017-04-26 17:21:07
 */
class AdminBase extends Base
{
    /**
     * 通过用户名查询管理员信息
     *
     * @param $user_name
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-26 17:22:08
     */
    public static function getAdminByUserName($user_name)
    {
        $admin = Admin::where('user_name', $user_name)->first();

        return $admin;
    }
}
