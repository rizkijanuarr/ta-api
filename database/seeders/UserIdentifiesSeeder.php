<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserIdentifiesSeeder extends Seeder
{

    public function run()
    {
        $data = [
            ['name' => 'Operator 1', 'slug' => 'operator-1'],
            ['name' => 'Operator 2', 'slug' => 'operator-2'],
            ['name' => 'Operator 3', 'slug' => 'operator-3'],
        ];

        DB::table('users_identifies')->insert($data);
    }

}
