<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    // USER TABLE SEEDER
    public function run()
    {
        // Membuat data pengguna (user)
        User::create([
            'name'      => 'Admin Tampan',
            'email'     => 'admintampan@gmail.com',
            'password'  => bcrypt('rahasia123')
        ]);

        // Menetapkan permission ke role
        $role = Role::find(1); // Mencari role dengan ID 1
        $permissions = Permission::all(); // Mengambil semua permission yang ada

        $role->syncPermissions($permissions); // Menyinkronkan permission dengan role

        // Menetapkan role dengan permission kepada user
        $user = User::find(1); // Mencari user dengan ID 1
        $user->assignRole($role->name); // Menetapkan role kepada user
    }
}
