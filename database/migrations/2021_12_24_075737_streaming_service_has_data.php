<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StreamingServiceHasData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streaming_service_has_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('streaming_service_id')->unsigned()->nullable();
            $table->bigInteger('streaming_service_data_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('streaming_service_id')->references('id')->on('streaming_services')->onDelete("cascade");
            $table->foreign('streaming_service_data_id')->references('id')->on('streaming_services_data')->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streaming_service_id');
        Schema::dropIfExists('streaming_service_data_id');
        Schema::dropIfExists('streaming_service_has_data');
    }
}
