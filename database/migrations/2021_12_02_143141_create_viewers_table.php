<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('is_valid')->default(1)->comment('有効かどうか');
            $table->string('login_id')->comment('ログインID（招待ID）');
            $table->string('password_text')->comment('パスワード共有用');
            $table->date('expiration_date')->comment('有効期限');
            $table->string('password')->comment('パスワード');
            $table->string('api_token', 500)->unique()->nullable();
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
        Schema::dropIfExists('viewers');
    }
}
