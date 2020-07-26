<?php

use Illuminate\Database\Seeder;
use ApamsServer\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'name' => 'Desenvolvedor',
            'email' => 'web@altatecnologia.com.br',
            'password' => Hash::make('102030')
        ]);
    }
}
