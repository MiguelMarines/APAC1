<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "id" => 1,
                "name" => "mutate",
                "rol" => "administrador",
                "email" => "admin@hotmail.com",
                "password" => "12345678",
            ],
        ]);
    }
}
