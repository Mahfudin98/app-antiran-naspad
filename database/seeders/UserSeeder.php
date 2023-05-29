<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ali Latukau',
                'email' => 'alilatukau@gmail.com',
                'password' => Hash::make('alilatukau'),
                'no_hp' => '081222005074',
                'level' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
