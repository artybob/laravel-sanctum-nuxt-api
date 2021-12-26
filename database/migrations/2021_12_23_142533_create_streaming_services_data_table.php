<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamingServicesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streaming_services_data', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->string('user_name')->nullable();
            $table->string('user_login')->nullable();
            $table->integer('stream_user_id')->nullable();
            $table->text('game_name')->nullable();
            $table->text('viewer_count')->nullable();
            $table->string('title')->nullable();
            $table->string('started_at')->nullable();
            $table->string('thumbnail_url')->nullable();
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
        Schema::dropIfExists('streaming_services_data');
    }
}
