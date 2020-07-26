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
            'email' => 'api@altatecnologia.com.br',
            'password' => Hash::make('102030'),
            'active' => 1,
            'permissoes' => json_encode([])
        ]);
    }
}
