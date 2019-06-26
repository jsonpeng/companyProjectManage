<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectRulesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->float('basic_cost')->comment('员工成本(社保等)');
            $table->float('man_prop')->comment('个人额外系数(基于工资和成本)');
            $table->float('first_price')->comment('第一阶段金额限度');
            $table->float('first_prop')->comment('第一阶段比例');
            $table->float('second_prop')->comment('第二阶段比例(超过第一限度后设定的分红比例)');
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
        Schema::drop('project_rules');
    }
}
