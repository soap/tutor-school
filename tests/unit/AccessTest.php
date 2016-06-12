<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccessTest extends TestCase
{
    /** @test */
    public function user_can_login()
    {
        $user = factory(App\Models\Access\User\User::class)->create(['password' => Hash::make('passw0RD')]);

        $this->visit('/login')
            ->type($user->email, 'email')
            ->type('passw0RD', 'password')
            ->press('Sign In')
            ->seePageIs('/home')
            ->see($user->first_name);
    }

    /** @test */
    public function warn_on_required_field_missing()
    {
        $this->visit('/login')
            ->type('', 'email')
            ->type('', 'password')
            ->press('Sign In')
            ->see('The email field is required')
            ->see('The password field is required');
    }

    /** @test */
    public function new_user_registration()
    {
        $this->visit('/register')
            ->type('Sergi Tur Badenas', 'name')
            ->type('sergiturbadenas@gmail.com', 'email')
            ->check('terms')
            ->type('passw0RD', 'password')
            ->type('passw0RD', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/home')
            ->seeInDatabase('users', ['email' => 'sergiturbadenas@gmail.com',
                'name'  => 'Sergi Tur Badenas', ]);
    }

    /** @test */
    public function required_fields_on_registratione()
    {
        $this->visit('/register')
            ->press('Register')
            ->see('The name field is required')
            ->see('The email field is required')
            ->see('The password field is required');
    }

    /** @test */
    public function send_password_reset_email()
    {
        $user = factory(App\Models\Access\User\User::class)->create();

        $this->visit('password/reset')
            ->type($user->email, 'email')
            ->press('Send Password Reset Link')
            ->see('We have e-mailed your password reset link!');
    }

    /** @test */
    public function not_send_password_reset_if_user_not_exists()
    {
        $this->visit('password/reset')
            ->type('notexistingemail@gmail.com', 'email')
            ->press('Send Password Reset Link')
            ->see('There were some problems with your input');
    }

    /** @test **/
    public function user_has_first_name_and_last_name()
    {
        // before using factory to create user, define it in /database/ModelFactory.php
        $user = factory(App\Models\Access\User\User::class)->make();

        $this->actingAs($user)
            ->visit('/')
            ->see($user->first_name.' '.$user->last_name);
    }

    /** @test **/
    public function user_has_api_token()
    {
        // before using factory to create user, define it in /database/ModelFactory.php
        $user = factory(App\Models\Access\User\User::class)->make();
        $this->seeInField('api_token', $user);

    }

    /** @test */
    public function user_can_logout()
    {
        $user = factory(App\Models\Access\User\User::class)->create();

        $this->actingAs($user)
            ->visit('/logout')
            ->seePageIs('/');
    }
}
