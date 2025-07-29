<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123'), // default password
            'role' => 'admin',
        ]);

        // Guru
        User::create([
            'name' => 'Guru 1',
            'email' => 'guru@mail.com',
            'password' => Hash::make('123'),
            'role' => 'guru',
        ]);

        // Siswa
        User::create([
            'name' => 'Siswa 1',
            'email' => 'siswa@mail.com',
            'password' => Hash::make('123'),
            'role' => 'siswa',
        ]);
    }
}
