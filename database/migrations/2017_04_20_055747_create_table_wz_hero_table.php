<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWzHeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_hero', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->default('')->comment('英雄名称');
            $table->integer('image_id')->default(0)->comment('图片ID');
            $table->integer('sort')->default(1)->comment('排序值');
            $table->tinyInteger('disabled')->default(0)->comment('是否显示(1:显示 0:隐藏)');
            $table->softDeletes();
            $table->timestamps();

            $table->index('name', 'name');
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
        Schema::dropIfExists('wz_hero');
    }
}
