<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSceneConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scene_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scene_id')->comment('シーンID')->constrained('scenes')->cascadeOnDelete();
            $table->foreignId('sensor_id')->nullable()->comment('センサーID')->constrained('sensors')->cascadeOnDelete();
            $table->foreignId('sensor_detail_id')->nullable()->comment('センサー詳細ID')->constrained('sensor_details')->cascadeOnDelete();
            $table->enum('type', ['numeric', 'timer'])->comment('数値、タイマー');
            $table->string('name')->comment('条件名（温度、湿度等）');
            // 数値条件用
            $table->enum('aggregation_type', ['single', 'double', 'triple'])->nullable()->comment('数値の集計タイプ　3つ同時に集計まである');
            $table->float('threshold')->nullable()->comment('閾値');
            $table->enum('wind_direction', ['above', 'below'])->nullable()->comment('以上・以下');
            // タイマー用
            $table->string('start_time')->nullable()->comment('開始時間');
            $table->string('end_time')->nullable()->comment('終了時間');
            $table->tinyInteger('monday')->default(0)->comment('実行曜日　月');
            $table->tinyInteger('tuesday')->default(0)->comment('実行曜日　火');
            $table->tinyInteger('wednesday')->default(0)->comment('実行曜日　水');
            $table->tinyInteger('thursday')->default(0)->comment('実行曜日　木');
            $table->tinyInteger('friday')->default(0)->comment('実行曜日　金');
            $table->tinyInteger('saturday')->default(0)->comment('実行曜日　土');
            $table->tinyInteger('sunday')->default(0)->comment('実行曜日　日');
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
        Schema::dropIfExists('scene_conditions');
    }
}
