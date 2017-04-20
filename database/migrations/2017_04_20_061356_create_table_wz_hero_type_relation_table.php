<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWzHeroTypeRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_hero_type_relation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hero_id')->default(0)->comment('英雄ID');
            $table->integer('hero_type_id')->default(0)->comment('英雄类型ID');
            $table->softDeletes();
            $table->timestamps();

            $table->index('hero_id', 'hero_id');
            $table->index('hero_type_id', 'hero_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wz_hero_type_relation');
    }
}
