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
        // users table
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            // $table->timestamp('username_verified_at')->nullable();
            $table->string('password');
            $table->longtext('profile_image')->nullable();
            $table->integer('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        // categories
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
        });

        // sub_categories
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('sub_category_name');

        $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');
        });

        // items
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name');
            $table->text('item_description');
            $table->longtext('item_image')->nullable();
            $table->integer('selling_price')->default(0);
            $table->integer('purchase_price')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();

            $table->integer('item_limit')->default(0);
            $table->integer('item_quantity')->default(0);
            $table->string('item_unit');

        $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');
        $table->foreign('sub_category_id')
            ->references('id')->on('sub_categories')
            ->onDelete('cascade');

        });

        // logs
        Schema::create('slr_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->integer('discount');
            $table->integer('total');
            $table->string('status');
            $table->timestamps();

        $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade');
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sub_categories');
        Schema::dropIfExists('items');
        Schema::dropIfExists('slr_logs');
    }
}
