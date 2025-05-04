<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hopearte.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Usuario de tipo company
        User::create([
            'name' => 'La Birra',
            'email' => 'labirra@gmail.com',
            'password' => Hash::make('labirra123'),
            'role' => 'company',
        ]);

        // Usuario normal
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@gmail.com',
            'password' => Hash::make('usuario123'),
            'role' => 'user',
        ]);
    }
}