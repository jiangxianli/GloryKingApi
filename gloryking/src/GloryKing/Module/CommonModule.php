<?php
namespace GloryKing\Module;

use Carbon\Carbon;
use GloryKing\Base\ImageBase;
use Library\ErrorMessage\ErrorMessage;
use Library\SimpleHtml\CURL;
use Library\SimpleHtml\SimpleHtml;
use Library\UploadFile\UploadFile;

/**
 * 通用模块
 *
 * Class CommonModule
 * @package GloryKing\Module
 * @author jiangxianli
 * @created_at 2017-04-21 17:37:24
 */
class CommonModule extends Module
{
    /**
     * 上传图片
     *
     * @param $file
     * @return \GloryKing\Model\Image|ErrorMessage
     * @author jiangxianli
     * @created_at 2017-04-21 17:44:35
     */
    public static function uploadImage($file)
    {
        //初始化上传器
        $upload = new UploadFile(['jpg', 'png'], 5 * 1024 * 1000);
        //上传文件
        $file = $upload->upload($file, Carbon::now()->format('Y-m-d'));

        //错误校验
        if (ErrorMessage::isError($file)) {
            return $file;
        }

        //保存图片
        $params = [
            'url'       => $upload->getFileUrl(),
            'path'      => $upload->getFilePath(),
            'extension' => $upload->getFileExtension()
        ];
        return ImageBase::addImage($params);
    }

    /**
     * 解析网络地址
     *
     * @param $from_url
     * @return array
     * @author jiangxianli
     * @created_at 2017-04-25 15:56:40
     */
    public static function parseVideoUrl($from_url)
    {
        $page_content = CURL::get($from_url, parse_url($from_url, PHP_URL_HOST));
        $page_content = mb_convert_encoding($page_content, 'utf-8', 'GBK,UTF-8,ASCII');
        $html         = SimpleHtml::str_get_html($page_content);

        $url       = '';
        $title     = '';
        $image_src = '';

        if (starts_with($from_url, 'https://m.v.qq.com')) {
            //获取视频结点
            $video_node = $html->find('#tenvideo_video_player_0', 0);
            $url        = $video_node ? $video_node->src : '';

            //获取封面图结点
            $video_node = $html->find('.tvp_poster_img', 0);
            $style      = $video_node ? $video_node->style : '';
            if ($style) {
                //匹配封面图地址
                $matched = preg_match('/(https|http)?:\/\/[^\s]+\.(jpg|png|gif|jpeg)/', $style, $matches);
                if ($matched && $matches) {
                    $image_src = $matches[0];
                }
            }
        } elseif (starts_with($from_url, 'http://video.duowan.cn')) {
            //获取视频结点
            $video_node = $html->find('#player video', 0);
            $url        = $video_node ? $video_node->src : '';

            //获取封面图结点
            $image_src = $video_node ? $video_node->poster : '';

            $title_node = $html->find('.video-title h1', 0);
            $title      = $title_node ? $title_node->innertext : '';

        } elseif (starts_with($from_url, 'http://wzry.duowan.cn/')) {
            //获取视频结点
            $video_node = $html->find('#container .art-cont video', 0);
            $video_node = $video_node ? $video_node : $html->find('.article-content video', 0);
            $url        = $video_node && $video_node->find('source', 0) ? $video_node->find('source', 0)->src : '';

            //获取封面图结点
            $image_src = $video_node ? $video_node->poster : '';

            $title_node = $html->find('#container .art-title', 0);
            $title_node = $title_node ? $title_node : $html->find('.article-content .article-title', 0);
            $title      = $title_node ? $title_node->innertext : '';


            if(!$url){
                $video_id = $html->find('.article-text[id^=video_]');
                $video_id = $video_id ? str_replace('video_','',$video_id->id) : '';

                if ($video_id) {
                    $info_url = 'http://video.duowan.cn/play/' . $video_id . '.html';
                    return self::parseVideoUrl($info_url);
                }
            }

        } else {
            return new ErrorMessage('12001');
        }

        if (!$url) {
            return new ErrorMessage('12002');
        }

        $response = [
            'url' => $url
        ];

        $image             = ImageBase::saveInternetImage($image_src);
        $response['image'] = $image;

        if ($title) {
            $response['title'] = $title;
        }

        return $response;
        //https://m.v.qq.com/x/cover/9/9ud9svo40zvaxlb.html?vid=v0396t870fu
    }
}
