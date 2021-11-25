<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->comment('機器ID')->constrained('devices')->cascadeOnDelete();
            $table->string('name')->comment('シーン名');
            // オンオフのみ
            $table->tinyInteger('power')->nullable()->comment('電源 ON/OFF');
            // エアコン
            $table->float('temperature')->nullable()->comment('エアコン用　温度');
            $table->enum('mode', ['cooling', 'heating', 'dehumidifier', 'auto', 'ventilation'])->nullable()->comment('エアコン用　運転モード（冷房、暖房、除湿、AUTO、送風）');
            $table->enum('air_flow', ['low', 'mid', 'high', 'auto', 'power'])->nullable()->comment('エアコン用　風量（弱、中、強、AUTO、パワフル）');
            $table->enum('wind_direction', ['vertical', 'horizontal', 'auto'])->nullable()->comment('エアコン用　風向（上下、左右、AUTO）');
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
        Schema::dropIfExists('scenes');
    }
}
