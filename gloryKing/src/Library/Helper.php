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
}
