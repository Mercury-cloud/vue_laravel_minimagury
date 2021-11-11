<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogFieldSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_sensors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->comment('センサーID')->constrained('sensors')->cascadeOnDelete();
            $table->dateTime('recorded_at')->comment('記録日時');
            $table->float('value')->comment('値');
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
        Schema::dropIfExists('log_field_sensors');
    }
}
