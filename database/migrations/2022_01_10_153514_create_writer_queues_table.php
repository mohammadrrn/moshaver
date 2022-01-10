<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriterQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writer_queues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->comment('آیدی منطقه')->nullable();
            $table->unsignedBigInteger('last_writer_id')->comment('آیدی نویسنده بعدی که آگهی برای آن ارسال خواهد شد')->nullable();
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('last_writer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('writer_queues');
    }
}
