<?php

use \AcceptanceTester as AT;
use Page\Acceptance as Page;

// @codingStandardsIgnoreFile

class SigninAsdAdminCest
{
    /**
     * Tests sign in As Admin
     *
     *
     * @param $I \AcceptanceTester
     *
     */
    public function testToSigninAdAdmin(AT $I)
    {
        $I->wantTo('log in as an admin user');
        $I->amOnPage('/backendcontrol');
        $I->fillField('Username','admin');
        $I->fillField('Password','lybe4ever');
        $I->click('Sign in');
        $I->wait(20);
        $I->see('Dashboard');
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
