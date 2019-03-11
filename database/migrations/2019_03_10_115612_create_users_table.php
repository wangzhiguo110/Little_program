<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',50)->default('')->comment('用户名');
            $table->string('password',32)->default('')->comment('密码');
            $table->string('img_url',150)->default('')->comment('用户头像');

            $table->enum('is_super',['1','2'])->default('1')->comment('是否超管1非超管 2 超管');
            $table->enum('status',['1','2'])->default('1')->comment('用户状态正常 2 不正常');

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
        Schema::dropIfExists('admin_users');
    }
}
