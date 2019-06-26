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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default('')->comment('用户名');
            $table->string('email')->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('is_admin')->default('否')->comment('是否是管理员');
            $table->string('type')->nullable()->default('')->comment('类型(前端|设计|后台|管理)');
            $table->string('birthday')->nullable()->default('')->comment('生日');
            $table->string('gender')->nullable()->default('')->comment('性别');
            $table->string('wechat')->nullable()->default('')->comment('微信号');
            $table->string('qq')->nullable()->default('')->comment('qq号');
            $table->string('tel')->nullable()->default('')->comment('手机号');
            $table->float('wages')->nullable()->default(0)->comment('基本工资');
            $table->string('head_img')->nullable()->default('')->comment('个人头像');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
