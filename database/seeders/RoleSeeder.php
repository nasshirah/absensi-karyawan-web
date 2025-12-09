<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $karyawan = Role::firstOrCreate(['name' => 'karyawan']);

        $firstUser = User::first();
        if ($firstUser && !$firstUser->hasRole($admin)) {
            $firstUser->assignRole($admin);
        }
    }
}

