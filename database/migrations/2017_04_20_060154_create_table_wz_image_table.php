<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWzImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->default('')->comment('图片访问路径');
            $table->string('path')->default('')->comment('图片物理路径');
            $table->string('extension', 10)->default('')->comment('后缀名');
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
        Schema::dropIfExists('wz_image');
    }
}
