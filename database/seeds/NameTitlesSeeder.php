<?php

use Illuminate\Database\Seeder;

class NameTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('name_titles')->insert([
            ['name' => 'ด.ช.'],
            ['name' => 'ด.ญ.'],
            ['name' => 'นาย'],
            ['name' => 'น.ส.'],
            ['name' => 'นาง']
        ]);
    }
}
