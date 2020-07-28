<?php

use Illuminate\Database\Seeder;
use ApamsServer\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'adopt_mail' => 'administrativo@apams.com.br',
            'maintenance' => false,
            'title' => 'Histório Apams',
            'description' => 'Lorem Ipsum da história!'
        ]);
    }
}
