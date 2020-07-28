<?php

use Illuminate\Database\Seeder;
use ApamsServer\Sponsors;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sponsors::create([
            'name' => 'Patrocinador',
            'email' => 'email@email.com',
            'cellphone' => '00000000000',
            'description' => 'descrição',
            'avatar' => ''
        ]);
    }
}
