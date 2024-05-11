<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // TEMPAT REGISTER SEEDER
    public function run()
    {
        $this->call(RolesTableSeeder::class);
    }
}
