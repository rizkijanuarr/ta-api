<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // TEMPAT REGISTER SEEDER
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserIdentifiesSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
