<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateprojectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('项目名称');
            $table->string('type')->nullable()->comment('项目类型');
            $table->string('main_man')->nullable()->comment('项目发起者(主要负责人)');
            $table->string('start_time')->nullable()->comment('开始时间');
            $table->string('end_time')->nullable()->comment('结束时间');
            $table->string('basic_time')->nullable()->comment('项目实际结束时间');
            $table->string('status')->nullable()->default('挂起')->comment('当前状态');
            $table->string('des')->nullable()->comment('项目描述');
            $table->float('price')->nullable()->comment('项目金额');
            $table->integer('products_id')->nullable()->comment('产品id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
