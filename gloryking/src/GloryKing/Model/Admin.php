<?php
namespace GloryKing\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 素材模型
 *
 * Class Element
 * @package GloryKing\Model
 * @author jiangxianli
 * @created_at 2017-04-20 14:47:45
 */
class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * 指定表名
     *
     * @var string
     */
    protected $table = 'wz_admin';

    /**
     * 指定可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'nick_name',
        'password',
    ];
}
