<?php

use \AcceptanceTester as AT;
use Page\Acceptance as Page;

// @codingStandardsIgnoreFile

class GeneralCest
{

    public function testSearch(AT $I)
    {
        $I->wantTo('search a specific product');
        $I->amOnPage('/');
        $I->fillField('#search','Lagan Kommod 600');
        $I->pressKey('#search',\Facebook\WebDriver\WebDriverKeys::ENTER);
        $I->seeInCurrentUrl('catalogsearch/result/');
        $I->see('Lagan Kommod 600');
        $I->dontSee('Your search returned no results.');
    }

    public function testSubscribeNewsLetter(AT $I)
    {
        $I->wantTo('subscribe to newsletter');
        $I->amOnPage('/');
        $I->fillField('#newsletter','AcceptTest'.rand(0,99).'@acceptance.se');
        $I->click('Subscribe');


        $I->waitForElementVisible('.messages', 5);
        $I->wait(3);
        $I->see('Thank you for your subscription.');
    }


}
