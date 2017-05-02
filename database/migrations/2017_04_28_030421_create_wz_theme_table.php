<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWzThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_theme', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('')->comment('专题名称');
            $table->integer('image_id')->default(0)->comment('专题封面');
            $table->integer('sort')->default(0)->comment('专题排序');
            $table->tinyInteger('disabled')->default(0)->comment('是否显示(1:显示 0:隐藏)');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wz_theme');
    }
}
