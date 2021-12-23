<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsersSettig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('splash_file')->nullable()->comment('スプラッシュ画像')->after('email');
            $table->string('splash_color')->nullable()->comment('スプラッシュ背景カラー')->after('splash_file');
            $table->tinyInteger('push_permission')->default(1)->comment('push権限')->after('splash_file');
            $table->tinyInteger('push_alert')->default(0)->comment('アラートのpush')->after('push_permission');
            $table->tinyInteger('push_scene')->default(0)->comment('シーンのpush')->after('push_alert');
            $table->tinyInteger('push_camera_shot')->default(0)->comment('カメラ撮影時のpush')->after('push_scene');
            $table->string('auth_code')->nullable()->comment('パスワード変更時認証コード')->after('push_camera_shot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('splash_file');
             $table->dropColumn('splash_color');
             $table->dropColumn('push_permission');
             $table->dropColumn('push_alert');
             $table->dropColumn('push_scene');
             $table->dropColumn('push_camera_shot');
             $table->dropColumn('auth_code');
        });
    }
}