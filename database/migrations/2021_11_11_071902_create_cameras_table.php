<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID')->constrained('users')->cascadeOnDelete();
            $table->foreignId('field_id')->comment('圃場ID')->constrained('fields')->cascadeOnDelete();
            $table->string('name')->comment('カメラ名');
            $table->tinyInteger('is_360_degree')->default(0)->comment('360度カメラかどうか');
            $table->tinyInteger('for_timelapse')->default(0)->comment('タイムラプス用かどうか');
            $table->integer('shooting_span')->nullable()->comment('タイムラプス用　撮影スパン');
            $table->integer('file')->nullable()->comment('直近の録画データ');
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
        Schema::dropIfExists('cameras');
    }
}
