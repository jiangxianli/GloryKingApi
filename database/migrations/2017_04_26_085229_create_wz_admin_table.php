<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWzAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wz_admin', function (Blueprint $table) {
            $table->increments('id');

            $table->string('user_name')->default('')->comment('用户名');
            $table->string('nick_name')->default('')->comment('昵称');
            $table->string('password')->default('')->comment('密码');
            $table->rememberToken();

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
        Schema::dropIfExists('wz_admin');
    }
}
