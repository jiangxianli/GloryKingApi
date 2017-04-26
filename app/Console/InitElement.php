<?php
namespace App\Console;

use GloryKing\Model\Element;
use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;
use GloryKing\Model\Image;
use GloryKing\Module\CommonModule;
use Illuminate\Console\Command;
use Library\ErrorMessage\ErrorMessage;
use Library\SimpleHtml\CURL;
use Library\SimpleHtml\SimpleHtml;

class InitElement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:init-element';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     * 备份
     */
    public function handle()
    {
        //\DB::statement('truncate table wz_element');

        //获取英雄数据
        $url          = 'http://wzry.duowan.com/1607/m_331814214726.html';
        $page_content = CURL::get($url, parse_url($url, PHP_URL_HOST));
        $page_content = mb_convert_encoding($page_content, 'utf-8', 'GBK,UTF-8,ASCII');
        $html         = SimpleHtml::str_get_html($page_content);

        $hero_nodes = $html->find('.swiper-container li');

        foreach ($hero_nodes as $hero_node) {
            //获取英雄名称
            $hero_name = $hero_node->find('span', 0) ? $hero_node->find('span', 0)->innertext : '';

            \Log::info('英雄名：' . $hero_name);

            $hero = Hero::where('name', $hero_name)->first();
            if (!$hero) {
                \Log::info('------找不到英雄------' . $hero_name);
            }

            $url          = $hero_node->find('a', 0)->href;
            $page_content = CURL::get($url, parse_url($url, PHP_URL_HOST));
            $page_content = mb_convert_encoding($page_content, 'utf-8', 'GBK,UTF-8,ASCII');
            $html         = SimpleHtml::str_get_html($page_content);

            $video_nodes = $html->find('.list-video a');
            foreach ($video_nodes as $video_node) {

                try {
                    $link = $video_node->href;
                    $link = str_replace('wzry.duowan.com', 'wzry.duowan.cn', $link);
                    \Log::info('链接:' . $link);
                    $parse = CommonModule::parseVideoUrl($link);

                    if (ErrorMessage::isError($parse)) {
                        \Log::error($parse->formatError());
                        continue;
                    }
                    \Log::info($parse);
                    $url   = array_get($parse, 'url', '');
                    $image = array_get($parse, 'image', '');
                    $title = array_get($parse, 'title', '');

                    if (!$url || !$title) {
                        continue;
                    }

                    $element = Element::where('title', $title)->orWhere('url', $url)->first();
                    if ($element) {
                        continue;
                    }

                    $element           = new Element();
                    $element->title    = $title;
                    $element->url      = $url;
                    $element->from_url = $link;
                    $element->hero_id  = $hero->id;
                    $element->image_id = $image ? $image->id : 0;
                    $element->disabled = 0;
                    $element->sort     = 1;
                    $element->save();

                    \Log::info($element);

                } catch (\Exception $exception) {
                    \Log::error($exception->getMessage());
                }

            }

        }
    }
}
