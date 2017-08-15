<?php

use \AcceptanceTester as AT;
use Page\Acceptance as Page;

// @codingStandardsIgnoreFile

class UserCest
{

    private $_username;
    private $_password;


    public function __construct()
    {
        $this->_setUsername();
        $this->_setPassword();
    }

    private function _setUsername()
    {
        $this->_username = "AcceptTest".rand(0,99);
        return $this->_username;
    }

    private function _setPassword()
    {
        $this->_password = "AcceptPass".rand(0,99);
        return $this->_password;
    }

    private function _setCredentials($login , $pass)
    {
        $this->_login = $login;
        $this->_pass = $pass;
    }


    /**
     * Tests sign in As Admin
     *
     *
     * @param $I \AcceptanceTester
     *
     */
    public function testToCreateUser(AT $I)
    {
        $I->wantTo('create a user');
        $I->amOnPage('/');
        $I->click('Create an Account');
        $I->fillField('First Name','Acceptance');
        $I->fillField('Last Name', $this->_username);
        $I->fillField('Email', $this->_username.'@acceptance.se');
        $I->fillField('Password',$this->_password);
        $I->fillField('Confirm Password',$this->_password);
        $I->click('.primary button');
        $I->wait(4);
        $I->see('Thank you for registering with Main Website Store.');
        $I->see('My Dashboard');
        $I->click('Account Information');
        $I->seeInCurrentUrl('customer/account/edit/');
        $I->expectTo('user account has been registered');
        $this->_setCredentials($this->_username, $this->_password);
    }

    public function testLogout(AT $I)
    {
        $I->click('.switch');
        $I->wait(4);
        $I->see('Sign Out');
        $I->click('Sign Out');
        $I->see('You are signed out');
        $I->expectTo('User is logged out');
    }



    public function testLogin(AT $I)
    {
        $I->wantTo('log in with created credentials');
        $I->amOnPage('/customer/account/login/');
        $I->fillField('Email', $this->_username.'@acceptance.se');
        $I->fillField('Password',$this->_password);
        $I->click('.primary button');
        $I->wait(4);
        $I->see('My Dashboard');
        $I->expectTo('User is logged in');
    }

    /**
     * Returns a configuration value for selected key
     * 
     * @param $configKey string
     */
    protected function getConfig($configKey)
    {
        $config = \Codeception\Configuration::config();
        $suiteSettings = \Codeception\Configuration::suiteSettings('acceptance', $config);
        return $suiteSettings['data'][self::CONFIG_NODE][$configKey];
    }
}
