<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan User di-import
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Poliklinik',
            'email' => 'admin@poliklinik.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
    }
}