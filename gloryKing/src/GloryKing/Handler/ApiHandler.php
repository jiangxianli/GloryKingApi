<?php
namespace GloryKing\Handler;

use GloryKing\Module\CommonModule;
use GloryKing\Module\ElementModule;
use GloryKing\Module\HeroModule;
use Illuminate\Support\Collection;
use Library\ErrorMessage\ErrorMessage;
use Library\Helper;

/**
 * Api接口处理器
 *
 * Class ApiHandler
 * @package GloryKing\Handler
 * @author jiangxianli
 * @created_at 2017-04-20 15:36:10
 */
class ApiHandler extends Handler
{
    /**
     * 获取元素列表
     *
     * @param array $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-20 17:56:46
     */
    public static function getElementList($condition = [])
    {
        $by = array_get($condition, 'by', '');
        switch ($by) {
            case 'hot':
            case 'hero':
            case 'all':
                $response = ElementModule::getElements($condition);
                if (ErrorMessage::isError($response)) {
                    return $response;
                }
                $response = array_map(function ($item) {
                    return [
                        'unique_id' => $item->unique_id,
                        'url'       => $item->url,
                        'title'     => $item->title,
                        'poster'    => $item->image ? Helper::fullUrl($item->image->url) : '',
                        'play_num'  => $item->play_num,
                        'raise_num' => $item->raise_num,
                    ];
                }, $response->items());

                break;
            case 'detail':
                $response = ElementModule::getElements([
                    'by'        => 'detail',
                    'unique_id' => array_get($condition, 'unique_id', 0)
                ]);
                if (ErrorMessage::isError($response)) {
                    return $response;
                }
                $response = [
                    'unique_id' => $response->unique_id,
                    'url'       => $response->url,
                    'title'     => $response->title,
                    'poster'    => $response->image ? Helper::fullUrl($response->image->url) : '',
                    'play_num'  => $response->play_num,
                    'raise_num' => $response->raise_num,
                ];
                break;
            default:
                $response = new ErrorMessage('2003');
                break;
        }

        return self::apiResponse($response);
    }

    /**
     * 获取英雄列表
     *
     * @param array $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-20 18:03:21
     */
    public static function getHeroList($condition = [])
    {
        $response = HeroModule::getHeroList($condition);

        if (ErrorMessage::isError($response)) {
            return self::apiResponse($response);
        }

        $by = array_get($condition, 'by', '');
        switch ($by) {
            case 'type_id':
                foreach ($response->items() as &$item) {
                    $item = [
                        'hero_id'   => $item->id,
                        'hero_name' => $item->name,
                        'image_url' => Helper::fullUrl($item->getImageSrc()),
                    ];
                }
                break;
            case 'type_hero':
                $response = $response->map(function ($hero_type) {
                    $hero = $hero_type->hero->map(function ($hero) {
                        return [
                            'hero_id'   => $hero->id,
                            'hero_name' => $hero->name,
                            'image_url' => Helper::fullUrl($hero->getImageSrc()),
                        ];
                    });

                    return [
                        'name' => $hero_type->name,
                        'hero' => $hero
                    ];
                });
                break;

        }

        return self::apiResponse($response);
    }

    /**
     * 获取所有的英雄类型
     *
     * @param array $condition
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-25 14:19:12
     */
    public static function getHeroTypeList($condition = [])
    {
        $response = HeroModule::getAllHeroType($condition);

        return self::apiResponse($response);
    }

    /**
     * 英雄类型操作
     *
     * @param array $condition
     * @param string $operate
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-21 16:01:27
     */
    public static function heroTypeOperate($condition = [], $operate = '')
    {
        $response = HeroModule::heroTypeOperate($condition, $operate);

        return self::apiResponse($response);
    }

    /**
     * 上传图片
     *
     * @param $file
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-21 17:44:35
     */
    public static function uploadImage($file)
    {
        $response = CommonModule::uploadImage($file);

        return self::apiResponse($response);
    }

    /**
     * 英雄操作
     *
     * @param array $condition
     * @param string $operate
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-24 14:59:41
     */
    public static function heroOperate($condition = [], $operate = '')
    {
        $response = HeroModule::heroOperate($condition, $operate);

        return self::apiResponse($response);
    }

    /**
     * 解析视频地址
     *
     * @param $from_url
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-25 14:43:31
     */
    public static function parseVideoUrl($from_url)
    {
        $response = CommonModule::parseVideoUrl($from_url);

        return self::apiResponse($response);
    }
}
