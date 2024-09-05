<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'role_name' => 'customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'role_name' => 'merchant',
            'email' => 'merchant@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
