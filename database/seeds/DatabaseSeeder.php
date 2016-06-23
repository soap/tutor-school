<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->command->info('Running DatabaseSeeder');
        Eloquent::unguard();

        $this->command->info('Seeding education levels');
        $this->call(EducationLevelsSeeder::class);

        $this->command->info('Seeding name titles');
        $this->call(NameTitlesSeeder::class);
    }
}
