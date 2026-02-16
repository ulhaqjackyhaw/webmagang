<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@magang.com',
            'password' => Hash::make('4DM1NHC2025'),
            'role' => 'admin',
        ]);

        // HC user
        User::create([
            'name' => 'Human Capital',
            'email' => 'hc@magang.com',
            'password' => Hash::make('PasswordnyaHC2025'),
            'role' => 'hc',
        ]);

        // TU role has been removed - registration is now public via landing page
    }
}
