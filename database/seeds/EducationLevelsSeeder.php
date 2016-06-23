<?php

use Illuminate\Database\Seeder;

class EducationLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('education_levels')->insert([
            ['name' => 'ประถมศึกษาปีที่ 1', 'short_name'=> 'ป.1'],
            ['name' => 'ประถมศึกษาปีที่ 2', 'short_name'=> 'ป.2'],
            ['name' => 'ประถมศึกษาปีที่ 3', 'short_name'=> 'ป.3'],
            ['name' => 'ประถมศึกษาปีที่ 4', 'short_name'=> 'ป.4'],
            ['name' => 'ประถมศึกษาปีที่ 5', 'short_name'=> 'ป.5'],
            ['name' => 'ประถมศึกษาปีที่ 6', 'short_name'=> 'ป.6'],
            ['name' => 'มัธยมศึกษาปีที่ 1', 'short_name'=> 'ม.1'],
            ['name' => 'มัธยมศึกษาปีที่ 2', 'short_name'=> 'ม.2'],
            ['name' => 'มัธยมศึกษาปีที่ 3', 'short_name'=> 'ม.3'],
            ['name' => 'มัธยมศึกษาปีที่ 4', 'short_name'=> 'ม.4'],
            ['name' => 'มัธยมศึกษาปีที่ 5', 'short_name'=> 'ม.5'],
            ['name' => 'มัธยมศึกษาปีที่ 6', 'short_name'=> 'ม.6'],
        ]);
    }
}
