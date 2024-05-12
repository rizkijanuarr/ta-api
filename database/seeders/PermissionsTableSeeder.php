<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    // PERMISSION TABLE SEEDER

    public function run()
    {
        // PERMISSION ROLES
        Permission::create(['name' => 'roles.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'api']);

        // PERMISSION FOR PERMISSIONS
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);

        // PERMISSION USER
        Permission::create(['name' => 'users.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'api']);

        // PERMISSION PENGADUAN CATEGORY
        Permission::create(['name' => 'pengaduan.categories.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.categories.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.categories.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.categories.delete', 'guard_name' => 'api']);

        // PERMISSION PENGADUAN STATUS
        Permission::create(['name' => 'pengaduan.statuses.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.statuses.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.statuses.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.statuses.delete', 'guard_name' => 'api']);

        // PERMISSION PENGADUAN
        Permission::create(['name' => 'pengaduan.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.delete', 'guard_name' => 'api']);

        // PERMISSION TANGGAPAN
        Permission::create(['name' => 'tanggapan.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'tanggapan.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'tanggapan.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'tanggapan.delete', 'guard_name' => 'api']);

    }
}
