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
//        $this->call(LibrarySeeder::class);
        $this->call(LibrarySeeder::class);
        $this->call(AdminSeeder::class);
    }
}
