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
        // $this->call(UsersTableSeeder::class);
        //$this->call(UsersSeeder::class);
        $this->call(StaffSeeder::class);
        // $this->call(PostSeeder::class);
        // $this->call(AnimalSeeder::class);
        // $this->call(SettingsSeeder::class);
        // $this->call(SponsorSeeder::class);
    }
}
