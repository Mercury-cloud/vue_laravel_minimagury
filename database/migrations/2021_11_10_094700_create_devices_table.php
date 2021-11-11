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
            $table->string('name')->comment('機器名');
            $table->string('icon')->nullable()->comment('アイコン');
            $table->string('description')->nullable()->comment('使用目的');
            $table->enum('type', ['switch', 'air_conditioner'])->default('switch')->comment('機器のタイプ');
            $table->float('temperature')->nullable()->comment('エアコン用　温度');
            $table->enum('mode', ['cooling', 'heating', 'dehumidifier', 'auto', 'ventilation'])->nullable()->comment('エアコン用　運転モード（冷房、暖房、除湿、AUTO、送風）');
            $table->enum('air_flow', ['low', 'mid', 'high', 'auto', 'power'])->nullable()->comment('エアコン用　風量（弱、中、強、AUTO、パワフル）');
            $table->enum('wind_direction', ['vertical', 'horizontal', 'auto'])->nullable()->comment('エアコン用　風量（上下、左右、AUTO）');
            $table->string('status')->nullable()->comment('現在の稼働状態');
            $table->string('schedule')->nullable()->comment('スケジュール');
            $table->tinyInteger('alert')->default(0)->comment('アラートの有無');
            $table->string('alert_text')->nullable()->comment('アラート内容');
            // $table->tinyInteger('timer')->default(0)->comment('タイマー');
            // $table->tinyInteger('zoom')->default(0)->comment('ズーム');
            // $table->tinyInteger('screenshot')->default(0)->comment('スクショ');
            // $table->tinyInteger('look_around')->default(0)->comment('見回し');
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
