<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGonggaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gonggao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('公告名称');
            $table->string('desc')->comment('公告详情');
            $table->string('author')->comment('发布者');
            $table->integer('dianzan')->nullable()->default(0)->comment('点赞数');
            $table->integer('watch')->nullable()->default(0)->comment('浏览量');
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
        Schema::dropIfExists('gonggao');
    }
}
