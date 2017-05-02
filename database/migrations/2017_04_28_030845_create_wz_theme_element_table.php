<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWzThemeElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_theme_element', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('element_id')->default(0)->comment('素材ID');
            $table->integer('theme_id')->default(0)->comment('专题ID');

            $table->softDeletes();
            $table->timestamps();

            $table->index('element_id', 'element_id');
            $table->index('theme_id', 'theme_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wz_theme_element');
    }
}
