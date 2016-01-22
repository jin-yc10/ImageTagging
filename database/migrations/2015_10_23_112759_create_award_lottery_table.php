<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardLotteryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image_path');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('lottery', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('award_id');
            $table->integer('prob');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('award_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('award_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('is_gotten');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('bigLottery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image_path');
            $table->integer('sum');
            $table->integer('current');
            $table->integer('remain');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('biglottery_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('biglottery_id');
            $table->integer('user_id');
            $table->integer('token');
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
        Schema::drop('awards');
        Schema::drop('lottery');
        Schema::drop('award_user');
        Schema::drop('bigLottery');
        Schema::drop('biglottery_user');
    }
}
