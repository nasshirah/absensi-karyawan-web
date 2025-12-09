<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
        if (method_exists($admin, 'assignRole')) {
            $admin->assignRole('admin');
        }

        // Default Karyawan
        $karyawan = User::firstOrCreate(
            ['email' => 'karyawan@example.com'],
            [
                'name' => 'Karyawan',
                'password' => Hash::make('password'),
            ]
        );
        if (method_exists($karyawan, 'assignRole')) {
            $karyawan->assignRole('karyawan');
        }
    }
}

