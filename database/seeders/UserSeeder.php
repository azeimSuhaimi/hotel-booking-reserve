<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '01452348',
            'role' => 'admin',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'users',
            'email' => 'user@gmail.com',
            'phone' => '01452347',
            'role' => 'user',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now(),
        ]);
    }
}
