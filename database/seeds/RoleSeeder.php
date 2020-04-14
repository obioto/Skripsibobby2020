<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RoleSeederTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'rolename' => 'Penggalang Dana',
        ],
        [    'rolename' => 'Admin'
        ]);
    }
}
