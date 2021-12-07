<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        Admin::firstOrCreate([
            "name" => "初期管理者2",
            "email" => "test@test.com",
        ],[
            "password" => bcrypt("password")
        ]);

    }
}
