<?php

use Illuminate\Database\Seeder;
use ApamsServer\Animals;
use ApamsServer\AnimalsGallery;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animals::insert([
            [
                'name' => 'Bob',
                'size' => 'Pequeno',
                'type' => 'Cachorro',
                'adopted' => 0,
                'history' => 'Descrição exemplo do Bob',
                'avatar_url' => '',
                'weight' => 120,
                'sex' => 'M',
                'age' => 10
            ],
            [
                'name' => 'Negão',
                'size' => 'Pequneo',
                'type' => 'Gato',
                'adopted' => 0,
                'history' => 'Descrição exemplo do Negão',
                'avatar_url' => '',
                'weight' => 120,
                'sex' => 'M',
                'age' => 10
            ],
            [
                'name' => 'Loki',
                'size' => 'Grande',
                'type' => 'Cachorro',
                'adopted' => 0,
                'history' => 'Descrição exemplo do Bob',
                'avatar_url' => '',
                'weight' => 120,
                'sex' => 'M',
                'age' => 10
            ]
        ]);

        AnimalsGallery::insert([
            [
                'image_url' => '',
                'animal_id' => 1
            ],
            [
                'image_url' => '',
                'animal_id' => 1
            ],
            [
                'image_url' => '',
                'animal_id' => 1
            ],
            [
                'image_url' => '',
                'animal_id' => 2
            ],
            [
                'image_url' => '',
                'animal_id' => 2
            ],
            [
                'image_url' => '',
                'animal_id' => 3
            ],
            [
                'image_url' => '',
                'animal_id' => 3
            ],
        ]);
    }
}
