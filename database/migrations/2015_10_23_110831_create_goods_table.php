<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('name');
            $table->integer('points');
            $table->integer('number');
            $table->string('image_path');
            $table->boolean('available');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('goods_user',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('goods_id');
            $table->unsignedInteger('user_id');
            $table->boolean('is_gotten');
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
        Schema::drop('goods');
        Schema::drop('goods_user');
    }
}
