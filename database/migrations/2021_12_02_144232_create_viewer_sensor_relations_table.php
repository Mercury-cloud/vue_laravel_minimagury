<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewerSensorRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewer_sensor_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('viewer_id')->comment('ビューワーID')->constrained('viewers')->cascadeOnDelete();
            $table->foreignId('sensor_id')->comment('センサーID')->constrained('sensors')->cascadeOnDelete();
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
        Schema::dropIfExists('viewer_sensor_relations');
    }
}
