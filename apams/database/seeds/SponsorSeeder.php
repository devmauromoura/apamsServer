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
            'name' => 'Patrocionador 1',
            'email' => 'email@email.com',
            'cellphone' => '00000000000',
            'avatar' => ''
        ]);
    }
}
