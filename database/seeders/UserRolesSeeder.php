<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user Admin
        User::factory()->admin()->create([
            'name' => 'Admin Elite',
            'email' => 'admin@rental.com', // Email untuk admin
            'password' => Hash::make('password'), // Password: 'password'
        ]);

        // Membuat user Biasa
        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@rental.com', // Email untuk user biasa
            'password' => Hash::make('password'), // Password: 'password'
            'role' => 'user', // Pastikan role-nya 'user'
        ]);
    }
}
