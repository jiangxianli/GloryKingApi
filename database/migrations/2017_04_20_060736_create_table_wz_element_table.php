<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWzElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_element', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->default('')->comment('唯一ID');
            $table->string('url')->default('')->comment('素材地址');
            $table->string('title')->default('')->comment('素材标题');
            $table->integer('image_id')->default(0)->comment('封面图');
            $table->integer('hero_id')->default(0)->comment('英雄ID');
            $table->integer('play_num')->default(0)->comment('播放次数');
            $table->integer('raise_num')->default(0)->comment('点赞次数');
            $table->integer('sort')->default(0)->comment('排序值');
            $table->tinyInteger('disabled')->default(0)->comment('是否显示(1:显示 0:隐藏)');
            $table->softDeletes();
            $table->timestamps();

            $table->index('unique_id', 'unique_id');
            $table->index('title', 'title');
            $table->index('image_id', 'image_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wz_element');
    }
}
