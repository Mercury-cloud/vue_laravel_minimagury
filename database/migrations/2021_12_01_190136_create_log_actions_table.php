<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->comment('機器ID')->constrained('devices')->cascadeOnDelete();
            $table->enum('type', ['manual', 'scene'])->default('scene')->comment('操作タイプ　手動かシーンか');
            $table->string('target')->comment('操作対象');
            $table->string('description')->comment('操作内容詳細');
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
        Schema::dropIfExists('log_actions');
    }
}
