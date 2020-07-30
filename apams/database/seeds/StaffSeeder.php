<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'email' => 'dev@altatecnologia.com.br',
            'password' => Hash::make('102030'),
            'avatar' => '',
            'permissoes' => json_encode(["postV","postC","postE","postR","animalV","animalC","animalE","animalR","userV","userC","userE","userR","patrocinadorV","patrocinadorC","patrocinadorE","patrocinadorR","configuracaoE"])
        ]);
        Staff::create([
            'name' => 'Apams',
            'email' => 'admin@apams.com.br',
            'password' => Hash::make('123456'),
            'avatar' => '',
            'permissoes' => json_encode(["postV","postC","postE","postR","animalV","animalC","animalE","animalR","userV","userC","userE","userR","patrocinadorV","patrocinadorC","patrocinadorE","patrocinadorR","configuracaoE"])
        ]);
    }
}
