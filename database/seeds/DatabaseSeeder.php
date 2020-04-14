<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory( \App\User::class , 10 )->create();
        $this->call([
            RoleSeeder::class,
        ]);
        //factory( \App\Kategori::class , 5 )->create();
        // factory( \App\Models\Konten::class , 20 )->create();

    }
}
