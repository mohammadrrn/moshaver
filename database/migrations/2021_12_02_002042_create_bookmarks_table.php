<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estate_request_id')->comment('آیدی درخواست');
            $table->unsignedBigInteger('user_id')->comment('آیدی کاربر');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estate_request_id')->references('id')->on('estate_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
