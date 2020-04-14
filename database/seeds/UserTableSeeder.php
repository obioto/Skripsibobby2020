<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($config['users'])->insert([
            'name' => 'Administrator',
            'email' => 'admin@database.com',
            'password' => Hash::make('123456'),
            'confirmed' => true,
            'note' => 'Admin',
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);
    }
}
