<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWzHeroTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_hero_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('类型名称');
            $table->integer('sort')->default(0)->comment('排序值');
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
        Schema::dropIfExists('wz_hero_type');
    }
}
