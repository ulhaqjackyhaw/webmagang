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
        User::updateOrCreate(
            ['email' => 'admin@magang.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('4DM1NHC2025'),
                'role' => 'admin',
            ]
        );

        // HC user
        User::updateOrCreate(
            ['email' => 'hc@magang.com'],
            [
                'name' => 'Human Capital',
                'password' => Hash::make('PasswordnyaHC2025'),
                'role' => 'hc',
            ]
        );

        // Div Head user
        User::updateOrCreate(
            ['email' => 'divhead@magang.com'],
            [
                'name' => 'Division Head',
                'password' => Hash::make('DivHead2025'),
                'role' => 'div_head',
            ]
        );

        // Deputy user
        User::updateOrCreate(
            ['email' => 'deputy@magang.com'],
            [
                'name' => 'Deputy HC',
                'password' => Hash::make('Deputy2025'),
                'role' => 'deputy',
            ]
        );
    }
}
