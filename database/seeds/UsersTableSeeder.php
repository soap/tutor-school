<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->command->info('Running UserTableSeeder');
        User::create([
            'email' => 'admin@admin.com',
            'first_name' => 'Admin',
			'last_name' => 'System',
            'password' => Hash::make('1234'),
            'registered' => true,
            'confirmed' => true
        ]);

    }
}
