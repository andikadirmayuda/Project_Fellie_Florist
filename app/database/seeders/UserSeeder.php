<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Manager
        User::create([
            'name' => 'Manager',
            'email' => 'manager@fellieflorist.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
        ]);

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@fellieflorist.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Kasir
        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@fellieflorist.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);

        // Karyawan
        User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@fellieflorist.com',
            'password' => Hash::make('karyawan123'),
            'role' => 'karyawan',
        ]);

        // Pelanggan
        User::create([
            'name' => 'Pelanggan',
            'email' => 'pelanggan@fellieflorist.com',
            'password' => Hash::make('pelanggan123'),
            'role' => 'pelanggan',
        ]);
    }
}
