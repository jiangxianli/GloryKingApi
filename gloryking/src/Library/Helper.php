<?php
namespace Library;

class Helper
{
    /**
     * 带域名全路径
     *
     * @param $url
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-25 14:15:45
     */
    public static function fullUrl($url)
    {
        return asset($url);
    }

    /**
     * 唯一ID
     *
     * @param string $prefix
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-26 11:50:10
     */
    public static function uuid($prefix = '')
    {
        $str  = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8);
        $uuid .= substr($str, 8, 4);
        $uuid .= substr($str, 12, 4);
        $uuid .= substr($str, 16, 4);
        $uuid .= substr($str, 20, 12);
        return ($prefix ? $prefix . '_' : '') . $uuid;
    }

    /**
     * 格式化显示视频时长
     *
     * @param $duration
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-27 15:37:13
     */
    public static function formatDurationTime($duration)
    {
        $minutes = intval($duration / 60);
        $seconds = intval($duration % 60);

        return ($minutes < 10 ? '0' . $minutes : $minutes) . ':' . ($seconds < 10 ? '0' . $seconds : $seconds);
    }
}
