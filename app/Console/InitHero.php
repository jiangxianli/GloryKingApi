<?php
namespace App\Console;

use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;
use GloryKing\Model\Image;
use Illuminate\Console\Command;
use Library\SimpleHtml\CURL;
use Library\SimpleHtml\SimpleHtml;

class InitHero extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:init-hero';

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
        \DB::statement('truncate table wz_hero');
        \DB::statement('truncate table wz_hero_type');
        \DB::statement('truncate table wz_hero_type_relation');

        $hero_type_items = [
            'new' => '体验服／新英雄爆料',
            'fs'  => '法师',
            'tk'  => '坦克',
            'ck'  => '刺客',
            'ss'  => '射手',
            'fz'  => '辅助',
        ];
        foreach ($hero_type_items as $hero_type_item) {
            $hero_type = HeroType::firstOrCreate(['name' => $hero_type_item]);
        }

        //获取英雄数据
        $url          = 'http://wzry.duowan.com/yujivideo/index_2.html';
        $page_content = CURL::get($url, parse_url($url, PHP_URL_HOST));
        $page_content = mb_convert_encoding($page_content, 'utf-8', 'GBK,UTF-8,ASCII');
        $html         = SimpleHtml::str_get_html($page_content);

        $hero_nodes = $html->find('ul.list-hero li');

        foreach ($hero_nodes as $hero_node) {
            \Log::info($hero_node->innertext);
            $hero_name = $hero_node->find('span.name', 0)->innertext;
            if (!$hero_name) {
                continue;
            }

            //创建英雄
            $hero = Hero::firstOrCreate(['name' => $hero_name]);

            //获取并保存图片到本地
            $image_url  = '/hero/' . time() . str_random(8) . '.png';
            $image_path = public_path($image_url);
            $dir        = dirname($image_path);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $image_src = $hero_node->find('img', 0)->src;
            file_put_contents($image_path, file_get_contents($image_src));

            //保存图片数据
            $image            = new Image();
            $image->url       = $image_url;
            $image->path      = $image_path;
            $image->extension = 'png';
            $image->save();

            $hero->image_id = $image->id;
            $hero->save();

            $type_name_arr = [];
            foreach (explode(' ', $hero_node->class) as $value) {
                if (array_key_exists($value, $hero_type_items)) {
                    $type_name_arr[] = $hero_type_items[$value];
                }
            }

            //查询英雄类型
            $hero_type_id = HeroType::whereIn('name', $type_name_arr)->pluck('id')->all();

            //英雄与类型关联
            $hero->heroType()->sync($hero_type_id);

        }
    }
}
