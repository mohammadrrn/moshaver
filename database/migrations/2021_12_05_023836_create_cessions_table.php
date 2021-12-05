<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estate_request_id')->comment('آیدی آگهی');
            $table->timestamps();
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
        Schema::dropIfExists('cessions');
    }
}
