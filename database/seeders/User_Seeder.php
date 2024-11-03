<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'vasudev sarswat',
            'email' => 'vasudev.sarswat2005@gmail.com',
            'password' => Hash::make('987654321'),
            'role' => 'admin' // specify a role, e.g., 'user' or 'admin'
        ]);
    }
}
