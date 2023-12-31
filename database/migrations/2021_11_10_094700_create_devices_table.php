<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID')->constrained('users')->cascadeOnDelete();
            $table->foreignId('field_id')->comment('圃場ID')->constrained('fields')->cascadeOnDelete();
            $table->string('name')->nullable()->comment('機器名');
            $table->string('icon')->nullable()->comment('アイコン');
            $table->string('description')->nullable()->comment('使用目的');
            $table->enum('type', ['switch', 'air_conditioner'])->default('switch')->comment('機器のタイプ');
            $table->tinyInteger('timer')->default(1)->comment('タイマー使用するか');
            $table->float('temperature')->nullable()->comment('エアコン用　温度');
            $table->enum('mode', ['cooling', 'heating', 'dehumidifier', 'auto', 'ventilation'])->nullable()->comment('エアコン用　運転モード（冷房、暖房、除湿、AUTO、送風）');
            $table->enum('air_flow', ['low', 'mid', 'high', 'auto', 'power'])->nullable()->comment('エアコン用　風量（弱、中、強、AUTO、パワフル）');
            $table->enum('wind_direction', ['vertical', 'horizontal', 'auto'])->nullable()->comment('エアコン用　風量（上下、左右、AUTO）');
            $table->string('status')->nullable()->comment('現在の稼働状態　ON・OFF');
            $table->string('schedule')->nullable()->comment('スケジュール');
            $table->float('upper_limit')->nullable()->comment('アラート　上限値');
            $table->string('upper_limit_inequality_sign')->nullable()->comment('アラート　上限等符号');
            $table->string('upper_limit_alert_text')->nullable()->comment('アラート　上限こえたときの文言');
            $table->float('lower_limit')->nullable()->comment('アラート　下限値');
            $table->string('lower_limit_inequality_sign')->nullable()->comment('アラート　下限等符号');
            $table->string('lower_limit_alert_text')->nullable()->comment('アラート　下限こえたときの文言');
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
        Schema::dropIfExists('devices');
    }
}
