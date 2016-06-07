<?php

use \FunctionalTester;
use Faker\Factory;

class SettingsCest
{
    private $faker;

    public function _before(FunctionalTester $I)
    {
        $I->checkIfLogin($I);

        $this->faker = Factory::create();
    }

    
    public function userDetails(FunctionalTester $I)
    {
        $I->wantTo('update the user details');
        $I->amOnPage('/settings/user_details');

        $firstName = $this->faker->firstName;

        $I->fillField(['name' => 'first_name'], $firstName);
        $I->fillField(['name' => 'last_name'], $this->faker->lastName);
        $I->click('Save');

        $I->seeResponseCodeIs(200);
        $I->seeRecord('users', array('first_name' => $firstName));
    }
}