<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_sensors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->comment('センサーID')->constrained('sensors')->cascadeOnDelete();
            $table->foreignId('user_id')->comment('ユーザーID')->constrained('users')->cascadeOnDelete();
            $table->foreignId('field_id')->comment('圃場ID')->constrained('fields')->cascadeOnDelete();
            $table->string('name')->comment('センサー名');
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
        Schema::dropIfExists('field_sensors');
    }
}
