<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use ApamsServer\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Desenvolvedor',
            'email' => 'web@altatecnologia.com.br',
            'password' => Hash::make('102030'),
            'activeAccount' => 1,
            'typeAccount' => 1
        ]);
        User::create([
            'name' => 'Desenvolvedor',
            'email' => 'api@altatecnologia.com.br',
            'password' => Hash::make('102030'),
            'activeAccount' => 1,
            'typeAccount' => 0
        ]);
    }
}
