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
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // TU user
        User::create([
            'name' => 'Tata Usaha',
            'email' => 'tu@magang.com',
            'password' => Hash::make('password'),
            'role' => 'tu',
        ]);

        // HC user
        User::create([
            'name' => 'Human Capital',
            'email' => 'hc@magang.com',
            'password' => Hash::make('password'),
            'role' => 'hc',
        ]);
    }
}
