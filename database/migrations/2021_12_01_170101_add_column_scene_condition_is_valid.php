<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSceneConditionIsValid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scene_conditions', function (Blueprint $table) {
            $table->tinyInteger('is_valid')->default(1)->comment('有効かどうか')->after('sensor_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scene_conditions', function (Blueprint $table) {
            $table->dropColumn('is_valid');
        });
    }
}