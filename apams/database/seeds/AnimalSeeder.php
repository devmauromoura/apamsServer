<?php

use Illuminate\Database\Seeder;
use ApamsServer\Animals;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animals::create([
            'name' => 'Bob',
            'size' => 'Grande',
            'type' => 'Cachorro',
            'adopted' => 0,
            'description' => 'Descrição exemplo do Bob',
            'avatarUrl' => 'teste'
        ]);
    }
}
