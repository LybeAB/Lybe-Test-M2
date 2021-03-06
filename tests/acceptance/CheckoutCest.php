<?php

use \AcceptanceTester as AT;
use Page\Acceptance as Page;

// @codingStandardsIgnoreFile

class CheckoutCest
{
    /**
     * Parent configuration node for custom values 
    */
    const CONFIG_NODE = 'checkout';
    
    /**
     * Tests add product to cart
     *
     * @group checkout
     *
     * @param $I \AcceptanceTester
     *
     */
    public function testAddProductToCart(AT $I)
    {
        //$I->comment('skipped');
        //return;

        $I->am('Customer');
        $I->wantTo('Add product to cart');
        $I->amGoingTo('open category page');

        $I->amOnPage(Page\Catalog::$CATEGORY_URL);
        $I->expectTo('see category page');

        $I->amGoingTo('open product page');
        $I->click(Page\Catalog::$categoryFirstProduct);
        $I->expectTo('see product page');
        $I->seeElement(Page\Catalog::$productBody);

        $I->amGoingTo('submit the form');
        $I->submitForm(Page\Catalog::$addToCartForm, array());

        $I->waitForElementVisible('.messages' , 3);

        $I->click('.showcart');
        $I->waitForElementVisible('.viewcart', 5);
        $I->click('.viewcart');

        $I->expectTo('see the cart page');
        $I->see('Shopping Cart');
        $I->seeInCurrentUrl(Page\Checkout::$CART_URL);

    }

    /**
     * Tests One Page Checkout
     *
     * @group checkout
     *
     * @param $I \AcceptanceTester
     *
     * @depends testAddProductToCart
     */
    public function testOnePageCheckout(AT $I)
    {
        $I->am('Customer');
        $I->wantTo('use One Page Checkout');
        $I->lookForwardTo('experience flawless checkout');
        $I->amGoingTo('place an order as a guest');
        $I->amOnPage(Page\Checkout::$URL);

        $I->amGoingTo("wait while checkout's form is loading");
        $I->waitForElementVisible('.checkout-shipping-address',10);

        $I->amGoingTo('fill my address');

        $I->fillField(Page\Checkout::$billingFirstname, $this->getConfig('firstname'));
        $I->fillField(Page\Checkout::$billingLastname, $this->getConfig('lastname'));
        $I->selectOption(Page\Checkout::$billingCountryId, $this->getConfig('country_id'));
        $I->fillField(Page\Checkout::$billingStreet1, $this->getConfig('street'));
        $I->fillField(Page\Checkout::$billingPostcode, $this->getConfig('postcode'));
        $I->fillField(Page\Checkout::$billingCity, $this->getConfig('city'));
        $I->fillField(Page\Checkout::$billingTelephone, $this->getConfig('phone'));

        $I->waitForElementVisible('.form-login',1);
        $I->see('Email Address');

        $I->fillField('#customer-email',$this->getConfig('username'));

        $I->amGoingTo('select shipping method');
        $I->waitForElementVisible(Page\Checkout::$shippingButtonsContainer);

        //$I->selectOption(Page\Checkout::$shippingMethodInput, Page\Checkout::$shippingMethod);
        $I->click('button', Page\Checkout::$shippingButtonsContainer);
        $I->wait($this->getConfig('timeout'));

        $I->waitForElementVisible(Page\Checkout::$paymentButtonsContainer);
        $I->see('Place Order');
        $I->click('Place Order');

    }

    /**
     * Tests Checkout Success page
     *
     * @group checkout
     *
     * @param $I AcceptanceTester
     *
     * @depends testOnePageCheckout
     */
    public function testOnePageCheckoutSuccess(AT $I)
    {
        $I->wait(15);
        $I->wantTo('Observe the order success page');
        $I->expectTo('see order success page');
        $I->seeInCurrentUrl(Page\Checkout::$SUCCESS_URL);
        $I->expectTo('be a happy customer');
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
