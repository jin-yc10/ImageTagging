<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatasetItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('datasets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('current_standard_id');
            $table->timestamps();
            $table->softDeletes();
        });

        // dataset <===> standard_item, 1-to-n
        Schema::create('standard_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('path');
            $table->integer('batch_count');
            $table->integer('dataset_id');
            $table->unique( array('slug','dataset_id','deleted_at') );
            $table->timestamps();
            $table->softDeletes();
        });

        // standard_item <===> item, 1-to-n
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->integer('standard_item_id'); // => table: standard_items
            $table->integer('count');
            $table->integer('flag')->default(0);
            $table->unique( ['path','standard_item_id','deleted_at'] );
            $table->timestamps();
            $table->softDeletes();
        });

        // labeled_item <===> item, 1-to-1
        Schema::create('labeled_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');// => table: items
            $table->timestamps();
            $table->softDeletes();
        });

        // user <===> item , n-to-m
        Schema::create('item_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');// => table: items
            $table->integer('user_id');// => table: users
            $table->boolean('label');
            $table->integer('batch_id');// => table: batches
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('wrong_item_user_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_user_id');// table: item_user
            $table->integer('user_id');
            $table->boolean('is_appeal')->default(false);
            $table->integer('is_appeal_passed')->default(-1);
            $table->timestamps();
            $table->softDeletes();
        });

        // user <===> item , n-to-m
        Schema::create('labeled_items_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('labeled_items_id');// => table: items
            $table->integer('user_id');// => table: users
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('standard_item_id');    // => table: items
            $table->integer('user_id');             // => table: users
            $table->integer('remain_count');        // => table: users
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
        //
        Schema::drop('datasets');
        Schema::drop('standard_items');
        Schema::drop('items');
        Schema::drop('item_users');
        Schema::drop('labeled_items');
        Schema::drop('wrong_item_user_labels');
        Schema::drop('labeled_items_users');
        Schema::drop('batches');

    }
}
