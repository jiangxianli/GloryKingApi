<?php
namespace Library\SimpleHtml;

/**
 * CURL
 * Class CURL
 * @package Library\SimpleHtml
 * @author jiangxianli
 * @created_at 2017-04-25 13:30:54
 */
class CURL
{
    /**
     * GET 请求
     *
     * @param $url
     * @param $host
     * @return mixed
     * @author jiangxianli
     * @created_at 2017-04-25 13:31:13
     */
    public static function get($url, $host = null , $headers = [])
    {
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($host || $headers) {
            if($host){
                $headers['host'] = $host;
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 6 Build/LYZ28E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/" . self::randomIp() . " Mobile Safari/537.36");
//        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/" . self::randomIp() . " Safari/536.11");
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    /**
     * 获取国内随机IP地址
     *
     * @return string
     * @author jiangxianli
     * @created_at 2017-04-25 13:35:52
     */
    protected static function randomIp()
    {

        $ip_long  = array(
            array('607649792', '608174079'), //36.56.0.0-36.63.255.255
            array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
            array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
            array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
            array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
            array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
            array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
            array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
            array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
            array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
        );
        $rand_key = mt_rand(0, 9);
        $ip       = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
        return $ip;
    }

} 