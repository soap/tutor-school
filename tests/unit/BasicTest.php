<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{

    /** @test */
    public function can_see_register_page()
    {
        $this->visit('/register')
            ->see('Register a new membership');
    }

    /** @test */
    public function can_see_reset_password_page()
    {
        $this->visit('/password/reset')
            ->see('Reset Password');
    }

    /**
     * Test home page is only for authorized Users.
     *
     * @return void
     */
    public function testHomePageForUnauthenticatedUsers()
    {
        $this->visit('/home')
            ->seePageIs('/login');
    }

    /**
     * Test home page works with Authenticated Users.
     *
     * @return void
     */
    public function testHomePageForAuthenticatedUsers()
    {
        $user = factory(App\Models\Access\User\User::class)->create();

        $this->actingAs($user)
            ->visit('/home')
            ->see($user->first_name);
    }


    /**
     * Test 404 Error page.
     *
     * @return void
     */
    public function test404Page()
    {
        $this->get('asdasdjlapmnnk')
            ->seeStatusCode(404)
            ->see('404');
    }


}
