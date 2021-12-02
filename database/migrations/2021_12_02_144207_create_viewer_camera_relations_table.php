<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewerCameraRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewer_camera_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('viewer_id')->comment('ビューワーID')->constrained('viewers')->cascadeOnDelete();
            $table->foreignId('camera_id')->comment('カメラID')->constrained('cameras')->cascadeOnDelete();
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
        Schema::dropIfExists('viewer_camera_relations');
    }
}
