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
        // 1. Buat Akun ADMIN (Hanya bisa lewat sini, tidak bisa register manual)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@chewytpad.com',
            'password' => Hash::make('password123'), // Password admin
            'role' => 'admin', // Kuncinya di sini
        ]);

        // 2. Buat Akun USER CONTOH (Opsional, biar gak capek register dulu buat ngetes)
        User::create([
            'name' => 'Mahasiswa Contoh',
            'email' => 'user@chewytpad.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}