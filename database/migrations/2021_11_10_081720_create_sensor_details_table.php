<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->comment('センサーID')->constrained('sensors')->cascadeOnDelete();
            $table->string('type')->comment('センサータイプ');
            $table->string('name')->comment('センサー名');
            $table->string('description')->nullable()->comment('機能');
            $table->float('precision')->comment('精度');
            $table->enum('precision_type', ['float', 'int'])->nullable()->comment('精度種類');
            $table->string('unit')->comment('単位');
            $table->float('measuring_range_lower_limit')->nullable()->comment('測定範囲　下限値');
            $table->float('measuring_range_upper_limit')->nullable()->comment('測定範囲　上限値');
            $table->float('lower_limit')->nullable()->comment('アラート　下限値');
            $table->string('lower_limit_inequality_sign')->nullable()->comment('アラート　下限等符号');
            $table->string('lower_limit_alert_text')->nullable()->comment('アラート　下限こえたときの文言');
            $table->float('upper_limit')->nullable()->comment('アラート　上限値');
            $table->string('upper_limit_inequality_sign')->nullable()->comment('アラート　上限等符号');
            $table->string('upper_limit_alert_text')->nullable()->comment('アラート　上限こえたときの文言');
            $table->tinyInteger('is_alert')->default(0)->comment('現在のアラートの有無');
            $table->string('alert_text')->nullable()->comment('現在のアラート内容');
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
        Schema::dropIfExists('sensor_details');
    }
}
