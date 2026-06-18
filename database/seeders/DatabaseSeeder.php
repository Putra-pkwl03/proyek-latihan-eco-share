<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Akun khusus untuk Admin
    \App\Models\User::create([
        'name' => 'Admin Koperasi Grids',
        'email' => 'admin@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        'role' => 'admin', // Set sebagai admin
    ]);

    // Akun khusus untuk Petani
    \App\Models\User::create([
        'name' => 'Brokline Petani Smart',
        'email' => 'brokline@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        'role' => 'petani', // Set sebagai petani
    ]);
}
}
