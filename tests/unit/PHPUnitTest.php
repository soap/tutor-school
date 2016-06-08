<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PHPUnitTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Tutor School')
            ->click('login')
            ->see('Password')
            ->click('Register')
            ->see('E-mail');
    }

    /** @test **/
    public function user_has_first_name_and_last_name()
    {
        // before using factory to create user, define it in /database/ModelFactory.php
        $user = factory(App\Models\Access\User\User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see($user->first_name.' '.$user->last_name);
    }
}
