<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEndpoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_details', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('sensor_id')->comment('エンドポイントURL');
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('field_id')->comment('エンドポイントURL');
        });
        Schema::table('cameras', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('field_id')->comment('エンドポイントURL');
        });
        Schema::table('scenes', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('device_id')->comment('エンドポイントURL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensor_details', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('cameras', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('scenes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
