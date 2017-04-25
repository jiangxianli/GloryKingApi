<?php
namespace App\Console;

use GloryKing\Model\Hero;
use GloryKing\Model\HeroType;
use GloryKing\Model\Image;
use Illuminate\Console\Command;
use Library\SimpleHtml\CURL;

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
        $hero_type_items = [
            '1' => '战士',
            '2' => '法师',
            '3' => '坦克',
            '4' => '刺客',
            '5' => '射手',
            '6' => '辅助',
        ];
        foreach ($hero_type_items as $hero_type_item) {
            $hero_type = HeroType::firstOrCreate(['name' => $hero_type_item]);
        }

        //获取英雄数据
        $url        = 'http://pvp.qq.com/web201605/js/herolist.json';
        $content    = CURL::get($url, 'pvp.qq.com');
        $hero_items = json_decode($content, true);

        foreach ($hero_items as $hero_item) {
            //创建英雄
            $hero = Hero::firstOrCreate(['name' => $hero_item['cname']]);

            //获取并保存图片到本地
            $image_url  = '/hero/' . time() . str_random(8) . '.png';
            $image_path = public_path($image_url);
            $dir        = dirname($image_path);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $image_src = 'http://game.gtimg.cn/images/yxzj/img201606/heroimg/' . $hero_item['ename'] . '/' . $hero_item['ename'] . '.jpg';
            file_put_contents($image_path, file_get_contents($image_src));

            //保存图片数据
            $image            = new Image();
            $image->url       = $image_url;
            $image->path      = $image_path;
            $image->extension = 'png';
            $image->save();

            $hero->image_id = $image->id;
            $hero->save();

            //查询英雄类型
            $hero_type = HeroType::firstOrCreate(['name' => $hero_type_items[$hero_item['hero_type']]]);

            //英雄与类型关联
            $hero->heroType()->sync([$hero_type->id]);

        }
    }
}
