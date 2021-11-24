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
            $table->enum('aggregation_type', ['single', 'double', 'triple'])->default('single')->comment('集計タイプ　3つ同時に集計まである');
            $table->float('upper_limit')->nullable()->comment('アラート　上限値');
            $table->string('upper_limit_inequality_sign')->nullable()->comment('アラート　上限等符号');
            $table->string('upper_limit_alert_text')->nullable()->comment('アラート　上限こえたときの文言');
            $table->float('lower_limit')->nullable()->comment('アラート　下限値');
            $table->string('lower_limit_inequality_sign')->nullable()->comment('アラート　下限等符号');
            $table->string('lower_limit_alert_text')->nullable()->comment('アラート　下限こえたときの文言');
            $table->tinyInteger('is_alert')->default(0)->comment('現在のアラートの有無');
            $table->string('alert_text')->nullable()->comment('現在のアラート内容');
            $table->string('latest_value')->nullable()->comment('最新のログの値');
            $table->string('latest_value2')->nullable()->comment('最新のログの値2 ');
            $table->string('latest_value3')->nullable()->comment('最新のログの値3 ');
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
