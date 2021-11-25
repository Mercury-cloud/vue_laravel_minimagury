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
            $table->string('type')->comment('センサータイプ');
            $table->string('name')->comment('センサー名');
            $table->string('description')->nullable()->comment('機能');
            $table->enum('aggregation_type', ['single', 'double', 'triple'])->default('single')->comment('集計タイプ　3つ同時に集計まである');
            $table->tinyInteger('is_alert')->default(0)->comment('現在のアラートの有無');
            $table->string('alert_text')->nullable()->comment('現在のアラート内容');
            $table->string('alert_text2')->nullable()->comment('現在のアラート内容2');
            $table->string('alert_text3')->nullable()->comment('現在のアラート内容3');
            $table->string('latest_value_text')->nullable()->comment('最新のログの項目名');
            $table->string('latest_value')->nullable()->comment('最新のログの値');
            $table->string('latest_value2_text')->nullable()->comment('最新のログの項目名2');
            $table->string('latest_value2')->nullable()->comment('最新のログの値2');
            $table->string('latest_value3_text')->nullable()->comment('最新のログの項目名3');
            $table->string('latest_value3')->nullable()->comment('最新のログの値3');
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
