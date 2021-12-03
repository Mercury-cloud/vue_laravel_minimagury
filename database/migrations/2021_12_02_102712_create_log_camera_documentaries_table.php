<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogCameraDocumentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_camera_documentaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camera_id')->comment('カメラID')->constrained('cameras')->cascadeOnDelete(); // nullOnDelete
            $table->string('file')->comment('データファイル保存先');
            $table->date('date')->comment('撮影日');
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
        Schema::dropIfExists('log_camera_documentaries');
    }
}
