<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $permission = Permission::create(['name' => 'pengaduan.categories.index', 'guard_name' => 'api']);
        $permission->alias('categories.index');
        $permission = Permission::create(['name' => 'pengaduan.categories.create', 'guard_name' => 'api']);
        $permission->alias('categories.create');
        $permission = Permission::create(['name' => 'pengaduan.categories.edit', 'guard_name' => 'api']);
        $permission->alias('categories.edit');
        $permission = Permission::create(['name' => 'pengaduan.categories.delete', 'guard_name' => 'api']);
        $permission->alias('categories.delete');

        // PERMISSION PENGADUAN STATUS
        $permission = Permission::create(['name' => 'pengaduan.statuses.index', 'guard_name' => 'api']);
        $permission->alias('statuses.index');
        $permission = Permission::create(['name' => 'pengaduan.statuses.create', 'guard_name' => 'api']);
        $permission->alias('statuses.create');
        $permission = Permission::create(['name' => 'pengaduan.statuses.edit', 'guard_name' => 'api']);
        $permission->alias('statuses.edit');
        $permission = Permission::create(['name' => 'pengaduan.statuses.delete', 'guard_name' => 'api']);
        $permission->alias('statuses.delete');

        // PERMISSION PENGADUAN
        Permission::create(['name' => 'pengaduan.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'pengaduan.delete', 'guard_name' => 'api']);

        // PERMISSION STATUS TANGGAPAN
        $permission = Permission::create(['name' => 'tanggapan.statuses.index', 'guard_name' => 'api']);
        $permission->alias('statuses.index');
        $permission = Permission::create(['name' => 'tanggapan.statuses.create', 'guard_name' => 'api']);
        $permission->alias('statuses.create');
        $permission = Permission::create(['name' => 'tanggapan.statuses.edit', 'guard_name' => 'api']);
        $permission->alias('statuses.edit');
        $permission = Permission::create(['name' => 'tanggapan.statuses.delete', 'guard_name' => 'api']);
        $permission->alias('statuses.delete');

        // PERMISSION TANGGAPAN
        Permission::create(['name' => 'tanggapan.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'tanggapan.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'tanggapan.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'tanggapan.delete', 'guard_name' => 'api']);

        // PERMISSION SLIDERS
        Permission::create(['name' => 'sliders.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'sliders.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'sliders.delete', 'guard_name' => 'api']);

    }
}