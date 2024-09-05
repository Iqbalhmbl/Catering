<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

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
