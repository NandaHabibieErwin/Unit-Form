<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => hash('sha256', 'pekanbarufighter'),
                'status' => 'admin',
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => hash('sha256', 'utschool11'),
                'status' => 'user',
            ]
        ], );
    }
}
