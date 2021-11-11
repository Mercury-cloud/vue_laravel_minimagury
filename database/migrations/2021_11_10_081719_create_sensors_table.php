<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID')->constrained('users')->cascadeOnDelete();
            $table->foreignId('field_id')->comment('圃場ID')->constrained('fields')->cascadeOnDelete();
            $table->string('name')->comment('センサー名');
            $table->string('description')->nullable()->comment('機能');
            $table->float('precision')->comment('精度');
            $table->enum('precision_type', ['float', 'int'])->nullable()->comment('精度種類');
            $table->string('unit')->comment('単位');
            $table->string('latest_value')->nullable()->comment('最新のログの値');
            $table->string('latest_value2')->nullable()->comment('最新のログの値2');
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
        Schema::dropIfExists('sensors');
    }
}
