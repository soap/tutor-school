<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that frontpage works');
$I->amOnPage('/');
$I->see('Home');

$I->wantTo('Ensure that login page shown');
$I->amOnPage('/login');
$I->see('Password');

$I->wantTo('Ensure that register page shown');
$I->amOnPage('/register');
$I->see('First Name');