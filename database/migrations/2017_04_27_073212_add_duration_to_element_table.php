<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDurationToElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wz_element', function (Blueprint $table) {
            $table->integer('duration')->default(0)->comment('视频播放时长')->after('image_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wz_element', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
}
