<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogSensorsTable extends Migration
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
            $table->foreignId('sensor_detail_id')->comment('センサー詳細ID')->constrained('sensor_details')->cascadeOnDelete();
            $table->float('value')->comment('測定値');
            $table->string('unit')->comment('単位');
            $table->text('note')->nullable()->comment('注釈');
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
        Schema::dropIfExists('log_sensors');
    }
}
