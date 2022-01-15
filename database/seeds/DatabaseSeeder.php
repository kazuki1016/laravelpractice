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
        //UsersTableSeederを呼び出す
        $this->call(UserTableSeeder::class);
    }
}
